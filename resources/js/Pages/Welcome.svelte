<script>
    import BlockHeader from "@/Components/BlockHeader.svelte";
    import * as feather from "feather-icons/dist/feather"
    import {inertia, Link, page} from '@inertiajs/svelte'
    import FrontPageContent from "@/Components/FrontPageContent.svelte";

    export let serverMessage;
    let test = "Hiya";
    export let topics;
    export let categories;
    export let frontpage;
    console.log(categories)
    console.log(topics)
    console.log(frontpage)
</script>

<svelte:head>
    <title>Welcome</title>
</svelte:head>

<div class="parent">
    <div class="div1 container grid-lg">
        <div class="columns">
            <div class="column col-xs-12">
                {#if frontpage !== 404}
                    <FrontPageContent post={frontpage}>
                    </FrontPageContent>
                    {:else }
                    <BlockHeader title="404 FrontPage Content">
                        <h3>Admin can set frontpage content in site settings</h3>
                    </BlockHeader>
                {/if}
                {#each categories as cata}
                    <BlockHeader title="{cata.name}">
                        <table class="table hover_effect">
                            <tbody>
                            {#each topics as topic}
                                {#if topic.category_id == cata.id}
                                    <tr class="c-hand" use:inertia="{{href: '/topic/' + topic.id, method: 'get'}}">
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
    <div class="div2 mr-2">
        <div class="card">
            {#if $page.props.auth.user == undefined}
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
            {:else }
                <div class="card-header">
                    <div class="card-title h5">
                        {$page.props.auth.user.name}
                    </div>
                    <div class="card-subtitle text-gray">
                        {$page.props.auth.user.status}
                    </div>
                </div>
                <div class="card-body">
                    {$page.props.auth.user.bio}
                </div>
                <div class="card-footer">
                </div>
            {/if}
        </div>

        {#if serverMessage !== undefined}

            <div class="toast toast-warning">
                <button class="btn btn-clear float-right"></button>
                {serverMessage}
            </div>
        {/if}

    </div>
</div>


<style>
    .hover_effect tbody tr {
        background-color: white;
        color: black;
        transition: 200ms;
    }

    .hover_effect tbody tr:hover {
        background-color: #3b4351;
        color: white;
        transition: 250ms;
    }

    .parent {
        height: 100%;
        width: 100%;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        grid-template-rows: repeat(5, 1fr);
        grid-column-gap: 0px;
        grid-row-gap: 0px;
    }

    .div1 {
        grid-area: 1 / 1 / 6 / 5;
        overflow-y: auto;
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

    .div2 {
        grid-area: 1 / 5 / 6 / 6;
    }
</style>
