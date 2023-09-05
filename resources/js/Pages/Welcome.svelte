<script>
    import BlockHeader from "@/Components/BlockHeader.svelte";
    import * as feather from "feather-icons/dist/feather"

    let test = "Hiya";
    export let topics;
    export let categories;
    console.log(categories)
    console.log(topics)
</script>

<svelte:head>
    <title>Welcome</title>
</svelte:head>

<div class="parent">
    <div class="div1 container grid-lg">
        <div class="columns">
            <div class="column col-xs-6">
                {#each categories as cata}
                    <BlockHeader title="{cata.name}">
                        <table class="table">
                            <tbody>
                            {#each topics as topic}
                                {#if topic.category_id == cata.id}
                                    <tr>
                                        <td>{@html feather.icons['message-square'].toSvg()} {topic.name}</td>
                                    </tr>
                                {/if}
                            {/each}

                            </tbody>
                        </table>
                    </BlockHeader>
                {/each}
            </div>
        </div>
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
