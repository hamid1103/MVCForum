<script>
    import BlockHeader from "@/Components/BlockHeader.svelte";
    import {inertia, Link} from '@inertiajs/svelte'
    import PostPreview from "@/Components/PostPreview.svelte";

    export let posts;
    export let topic_data;
    console.log(topic_data)
    console.log(posts);
</script>

<svelte:head>
    <title>{topic_data.name}</title>
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
        {#if topic_data.type === 'default'}

            <div class="div1 container grid-lg">
                {#each posts.data as post}
                    <PostPreview post="{post}"></PostPreview>
                {/each}
            </div>

        {:else if topic_data.type === 'media'}
            <div class="div1">
                <div class="container">
                    <div class="columns">
                        <div class="column col-12">
                            
                        </div>
                    </div>
                </div>
            </div>
        {/if}
    {/if}

    <div class="div2">
        <div class="card mr-2">
            <div class="card-header">
                <div class="card-title h5">
                    {topic_data.name}
                </div>
                <div class="card-subtitle text-gray">
                    A topic
                </div>
            </div>
            <div class="card-body">
                {topic_data.description}
            </div>
            <div class="card-footer">
                <div class="btn-group btn-group-block">
                    <button class="btn btn-primary"
                            use:inertia="{{href: '/topic/'+topic_data.id+'/newPost', method: 'get'}}">New Post
                    </button>
                    <button class="btn">Be</button>
                    <button class="btn">Buttons</button>
                </div>
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
