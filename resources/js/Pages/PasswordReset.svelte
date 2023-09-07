<script>
    import BlockHeader from "@/Components/BlockHeader.svelte";

    export let creds;

    let pw1;
    let pw2;
    let error = '';

    function checkMatch() {
        if (pw2 !== pw1) {
            error = "Passwords don't match"
        } else {
            error = ''
        }
    }

</script>

<div class="container">
    <div class="columns">
        <div class="column col-xs-9">
            <BlockHeader title="password reset">
                <form>
                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input class="form-input" type="password" bind:value={pw1}>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Repeat Password</label>
                        <input class="form-input" type="password" bind:value={pw2} on:keydown={checkMatch}>
                        {#if error !== ''}
                            <div class="bg-error">{error}</div>
                        {/if}
                    </div>
                </form>
            </BlockHeader>
        </div>
    </div>
</div>
