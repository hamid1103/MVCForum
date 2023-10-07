<script>
    export let title;
    export let tags = [];
    console.log(tags)
</script>

<div class="card mb-4">
    <div class="card-header bg-dark">
        <h2>{title}</h2>
        {#each tags as tag}
                <span class="chip" style="color: #3b4351">{tag.tag.name}</span>
        {/each}
    </div>
    <slot>

    </slot>
</div>
