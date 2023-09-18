<script>
    export let reply;
</script>
<div class="card mb-4">
    <div class="card-header">
        <div class="columns">
            <div class="column col-5">
                <div class="page-item-subtitle">By {reply.user.name}</div>
                <div class="page-item-subtitle">At {reply.created_at}</div>
            </div>
            <div class="column col-7">

            </div>
        </div>
    </div>
    <div class="card-body">
        {#each reply.context.blocks as block}
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

