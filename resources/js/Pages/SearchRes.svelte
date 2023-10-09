<script>
    import BlockHeader from "@/Components/BlockHeader.svelte";
    import {inertia, Link, router} from '@inertiajs/svelte'
    import PostPreview from "@/Components/PostPreview.svelte";

    export let posts;
    export let search = {
        textSearch: '',
        tags: []
    };
    if (!search.tags)
        search.tags = []
    if(search.textSearch=null)
        search.textSearch=''

    console.log(posts);
    console.log(search)

    async function getTags(s = '') {
        const response = await fetch("/getTags/" + s);
        let data = await response.json();
        console.log(data)
        return data
    }

    let tagsPromise = getTags()
    let tagsearch = ''

    function handleTagInput() {
        console.log(tagsearch)
        tagsPromise = getTags(tagsearch)
    }

</script>

<svelte:head>
    <title>Search Posts</title>
</svelte:head>

<div class="parent">
    {#if posts.data.length == 0}
        <div class="div1 container grid-lg">
            <div class="columns">
                <div class="column col-xs-6">
                    <BlockHeader title="Ain't nothing in here"></BlockHeader>
                </div>
            </div>
        </div>
    {:else }
        <div class="div1 container grid-lg">
            {#each posts.data as post}
                <PostPreview post="{post}"></PostPreview>
            {/each}
        </div>
    {/if}

    <div class="div2 mr-2">
        <div class="card mr-2">
            <div class="card-body">
                <input class="form-input" bind:value={search.textSearch}>
                <form on:submit|preventDefault={handleTagInput}>
                    <div class="popover popover-left">
                        <input class="form-input" type="text" id="input-example-1" bind:value={tagsearch}
                               placeholder="Search Tags">
                        <div class="popover-container">
                            <div class="card">
                                <div class="card-body">
                                    {#await tagsPromise}
                                        <p>...waiting</p>
                                    {:then tags}
                                        {#each tags as tag}
                                            <span class="chip c-hand"
                                                  on:click={()=>{if(!search.tags){search.tags = []}; search.tags = [...search.tags, tag]; console.log(search.tags)}}>{tag.name}</span>
                                        {/each}
                                    {:catch error}
                                        <p style="color: red">{error.message}</p>
                                    {/await}

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div>
                    {#if search.tags !== undefined}
                        {#each search.tags as tag, i}
                                <span class="chip c-hand" on:click={()=>{
                                    let newArr = search.tags.splice(i,1)
                                    search.tags = search.tags
                                }}>{tag.name} - {i}</span>
                        {/each}
                    {/if}
                </div>
                <button class="btn btn-primary" on:click={()=>{
                    let textSearchParam;
                    if(search.textSearch !== '' || search.textSearch !== undefined)
                    {textSearchParam = new URLSearchParams({search: search.textSearch}); console.log(search.textSearch)}
                    const tagsSearchParam = new URLSearchParams(search.tags.map(s=>['tags[]',s.id]))
                    console.log(tagsSearchParam.toString())
                    if(search.textSearch==undefined){
                    router.visit('/posts?'+tagsSearchParam.toString())
                    }else {
                    router.visit('/posts?'+textSearchParam.toString()+'&'+tagsSearchParam.toString())
                    }
                }}>Search
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .parent {
        height: 100%;
        width: 100%;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        grid-template-rows: repeat(5, 1fr);
        grid-column-gap: 0px;
        grid-row-gap: 0px;
    }

    .div1 {
        grid-area: 1 / 1 / 6 / 5;
    }

    .div2 {
        grid-area: 1 / 5 / 6 / 6;
    }
</style>
