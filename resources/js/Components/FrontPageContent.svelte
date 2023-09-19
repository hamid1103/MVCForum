<script>
    export let post;
    post = JSON.parse(post)
    console.log(post)
</script>

<div class="card mb-4">
    <div class="card-body text-center">
        {#each post.blocks as block}
            {#if block.type == 'header'}
                <p class="h{block.data.level}">{@html block.data.text}</p>
            {:else if block.type == 'paragraph'}
                <p>{@html block.data.text}</p>
            {:else if block.type == 'image'}
                <div class="flex-centered">
                    <img src="{block.data.url}" alt="{block.data.caption}" class="img img-responsive">

                </div>
            {/if}
        {/each}
    </div>
</div>

