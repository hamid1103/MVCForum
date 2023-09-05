<script>
    export let posts;
    export let topic_data;
</script>

<div class="parent">
    <div class="div1 container grid-lg">
        {#if posts == undefined}
            Ain't nothing in here
        {/if}
    </div>
    <div class="div2">
        <div class="card">
            <div class="card-header">
                <div class="card-title h5">
                    Sidebar
                </div>
                <div class="card-subtitle text-gray">
                    As you can see, it's barren.
                </div>
            </div>
            <div class="card-body">
                I forgot what i wanted to put here.<br>
                Oh there is a footer... nice<br>
                Gonna put some buttons there
            </div>
            <div class="card-footer">
                <div class="btn-group btn-group-block">
                    <button class="btn btn-primary">This</button>
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

    .div1 { grid-area: 1 / 1 / 6 / 5; }
    .div2 { grid-area: 1 / 5 / 6 / 6; }
</style>
