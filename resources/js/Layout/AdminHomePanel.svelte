<script>
    import {inertia} from '@inertiajs/svelte'
</script>

<div class="card">
    <div class="card-header">
        <div class="card-title h5 flex-centered">Admin Panel</div>
        <div class="btn-group btn-group-block">
            <a use:inertia href="/admin" class="btn" >Home</a>
            <button class="btn">Server Settings</button>
            <a use:inertia href="/admin/siteSettings" class="btn">Site Settings</a>
            <a use:inertia href="/admin/roles" class="btn">Roles</a>
            <a use:inertia href="/admin/tags" class="btn">Tags</a>
            <button class="btn">Categories</button>
            <button class="btn">Topics</button>
        </div>
    </div>
    <div class="card-body">
        <slot>

        </slot>
    </div>
</div>
