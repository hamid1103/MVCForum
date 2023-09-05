<script>
    export let title;
</script>

<div class="card mb-4">
    <div class="card-header bg-dark">
        <h2>{title}</h2>
    </div>
    <div class="card-body">
        <slot>

        </slot>
    </div>
</div>
