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
                {#if block.data.file}
                    <div class="flex-centered">
                        <img src="{window.location.origin+block.data.file.url}"
                             alt="{window.location.origin+'/'+block.data.file.url}" class="img img-responsive">

                    </div>
                {/if}
            {/if}
        {/each}
    </div>
</div>

