<script>
    import {inertia, page} from '@inertiajs/svelte'

    export let appname = "Bafu"
</script>
<div class="parent">
    <div class="LayoutTopbar">
        <header class="navbar bg-gray p-2 s-rounded">
            <section class="navbar-section">
                <a use:inertia href="/" class="navbar-brand text-bold mr-2">{appname}</a>
                <a use:inertia href="/" class="btn btn-link tooltip tooltip-bottom" data-tooltip="Test">Test</a>
                <a use:inertia href="/" class="btn btn-link">Test2</a>
            </section>
            <section class="navbar-section">

            </section>
            <section class="navbar-section">

                {#if $page.props.auth.user == undefined}
                    <a use:inertia href="/signin" class="btn btn-primary mr-2">Sign in</a>
                {:else }
                    <div class="popover popover-bottom">
                        <figure class="avatar avatar-lg mr-2" data-initial="{$page.props.auth.user.name.slice(0, 2)}" style="background-color: #5755d9;"></figure>
                        <div class="popover-container">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title h5">{$page.props.auth.user.name}</div>
                                    <div class="card-subtitle text-gray">
                                        {#if $page.props.auth.user.verified == 0}
                                            Unverified
                                            {:else }
                                            Verified
                                            {/if}
                                    </div>
                                </div>
                                <div class="card-body">
                                    ...
                                </div>
                                <div class="card-footer">
                                    <a use:inertia href="/logout" class="btn btn-primary">Log out</a>
                                </div>
                            </div>
                        </div>
                    </div>

                {/if}

                <div class="input-group input-inline">
                    <input class="form-input" type="text" placeholder="search">
                    <button class="btn btn-primary input-group-btn">Search</button>
                </div>
            </section>
        </header>
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

    .LayoutTopbar {
        grid-area: 1 / 1 / 2 / 6;
        padding: 1em;
    }

    .LayoutContent {
        grid-area: 2 / 1 / 6 / 6;
    }
</style>
