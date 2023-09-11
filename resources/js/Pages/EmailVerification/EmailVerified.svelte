<script>
    import {inertia} from "@inertiajs/svelte";
</script>

<div class="empty">
    <div class="empty-icon">
        <i class="icon icon-people"></i>
    </div>
    <p class="empty-title h5">You have successfully verified your email!</p>
    <p class="empty-subtitle">You can now make posts and comments.</p>
    <div class="empty-action">
        <button use:inertia href="/" class="btn btn-primary">See topics</button>
    </div>
</div>
