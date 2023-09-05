<script>
    import { inertia } from '@inertiajs/svelte'
</script>
<div class="parent">
    <div class="LayoutTopbar">

    </div>
    <div class="LayoutRightbar">
        <a use:inertia href="/">Home</a>
    </div>
    <div class="LayoutContent">
    <slot>

    </slot>
    </div>
</div>

<style>
    .parent {
        height: 100vh;
        width: 100vw;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        grid-template-rows: 0.5fr repeat(4, 1fr);
        grid-column-gap: 0px;
        grid-row-gap: 0px;
    }

    .LayoutTopbar { grid-area: 1 / 1 / 2 / 6; }
    .LayoutRightbar { grid-area: 2 / 5 / 6 / 6; }
    .LayoutContent { grid-area: 2 / 1 / 6 / 5; }
</style>
