<script>
    import BlockHeader from "@/Components/BlockHeader.svelte";

    export let post;
    console.log(post)
</script>
<div class="div1 container grid-lg" style="overflow-y: auto;">
    <div class="columns">
        <div class="column col-sm-6">
            <BlockHeader title="{post.name}">
                {#each post.content.blocks as block}
                    {#if block.type == 'header'}
                        <p class="h{block.data.level}">{@html block.data.text}</p>
                    {:else if block.type == 'paragraph'}
                        <p>{@html block.data.text}</p>
                    {/if}
                {/each}
            </BlockHeader>
        </div>
    </div>
</div>

<style>
    .div1{
        height: 100%
    }

    .div1::-webkit-scrollbar {
        width: 8px;
    }

    .div1::-webkit-scrollbar-track {
        box-shadow: inset 0 0 6px rgba(25, 0, 0, 0.3);
    }

    .div1::-webkit-scrollbar-thumb {
        background-color: darkgray;
        border-radius: 10px;
    }

</style>
