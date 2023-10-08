<script>
    import BlockHeader from "@/Components/BlockHeader.svelte";
    import {inertia, Link} from '@inertiajs/svelte'
    import PostPreview from "@/Components/PostPreview.svelte";

    export let posts;
    export let search;
    console.log(posts);
    console.log(search)
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

    <div class="div2">
        <div class="card mr-2">
            <div class="card-header">
                <div class="card-title h5">

                </div>
            </div>
            <div class="card-body">

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
