<script>
    import {inertia} from "@inertiajs/svelte";
</script>

<div class="empty">
    <div class="empty-icon">
        <i class="icon icon-people"></i>
    </div>
    <p class="empty-title h5">You have successfully signed up!</p>
    <p class="empty-subtitle">Check your email to verify your account.</p>
    <div class="empty-action">
        <a use:inertia href="/" class="btn btn-primary">See topics</a>
    </div>
</div>



