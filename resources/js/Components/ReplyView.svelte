<script>
    export let reply;
</script>
<div class="card">
    <div class="card-header">
        <div class="columns">
            <div class="column col-3">

            </div>
            <div class="column col-9">

            </div>
        </div>
    </div>
    <div class="card-body">
        {#each reply.content.blocks as block}
            {#if block.type == 'header'}
                <p class="h{block.data.level}">{@html block.data.text}</p>
            {:else if block.type == 'paragraph'}
                <p>{@html block.data.text}</p>
            {:else if block.type == 'image'}
                <img src="{block.data.url}" alt="{block.data.caption}" class="img img-responsive">
            {/if}
        {/each}
    </div>
</div>

