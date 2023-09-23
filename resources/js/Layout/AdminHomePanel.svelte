<script>
    import {inertia, page} from '@inertiajs/svelte'

    let ShowToast = false
    $: if ($page.props.flash.alert){
        ShowToast = true
    }else{ ShowToast=false}

    export let appname = "Bafu"
</script>
{#if ShowToast}
    <div class="toast toast-{$page.props.flash.alert.type}">
        <button class="btn btn-clear float-right"
                on:click={()=>{ShowToast = false}}></button>{$page.props.flash.alert.message}</div>
{/if}

<div class="LayoutTopbar">
    <header class="navbar bg-gray p-2 s-rounded">
        <section class="navbar-section">
            <a use:inertia href="/" class="navbar-brand text-bold mr-2">{appname}</a>
            <a use:inertia href="/about" class="btn btn-link tooltip tooltip-bottom"
               data-tooltip="About us">About</a>
            {#if $page.props.auth.user && $page.props.auth.user.role === 'admin'}
                <a use:inertia href="/admin" class="btn btn-link">Admin</a>
            {/if}
        </section>
        <section class="navbar-section">

        </section>
        <section class="navbar-section">

            {#if $page.props.auth.user == undefined}
                <a use:inertia href="/signin" class="btn btn-primary mr-2">Sign in</a>
            {:else }
                <div class="popover popover-bottom">
                    <figure use:inertia href="/user" class="avatar avatar-lg mr-2" data-initial="{$page.props.auth.user.name.slice(0, 2)}"
                            style="background-color: #5755d9;"></figure>
                    <div class="popover-container">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title h5">{$page.props.auth.user.name}</div>
                                <div class="card-subtitle text-gray">
                                    {#if $page.props.verified == 0}
                                        Unverified
                                    {:else }
                                        Verified
                                    {/if}
                                </div>
                            </div>
                            <div class="card-body">
                                <a use:inertia href="/settings" class="btn-link">
                                    Settings
                                </a>
                            </div>
                            <div class="card-footer">
                                <a use:inertia href="/logout" class="btn btn-primary">Log out</a>
                            </div>
                        </div>
                    </div>
                </div>
            {/if}

            <div class="popover popover-bottom">
                <button class="btn btn-primary">Search</button>
                <div class="popover-container">
                    <div class="card">
                        <div class="card-header">
                            ...
                        </div>
                        <div class="card-body">
                            ...
                        </div>
                        <div class="card-footer">
                            ...
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title h5 flex-centered">Admin Panel</div>
        <div class="btn-group btn-group-block">
            <a use:inertia href="/admin" class="btn" >Home</a>
            <button class="btn">Server Settings</button>
            <a use:inertia href="/admin/siteSettings" class="btn">Site Settings</a>
            <button class="btn">Roles</button>
            <button class="btn">Tags</button>
            <button class="btn">Categories</button>
            <button class="btn">Topics</button>
        </div>
    </div>
    <div class="card-body">
        <slot>

        </slot>
    </div>
</div>
