<script>
    import BlockHeader from "@/Components/BlockHeader.svelte";
    import {useForm} from "@inertiajs/svelte";

    export let user;
    export let settings;
    settings = settings[0]
    console.log([user, settings])

    let bioInput;
    let BioForm = useForm({
        bio: ''
    })

    function UpdateBio() {
        $BioForm.bio = bioInput.value
        $BioForm.post('/updateBio');
    }

    let statusInput;
    let statusForm = useForm({
        status: ''
    });

    function UpdateStatus() {
        $statusForm.status = statusInput.value
        $statusForm.post('/updateStatus');
    }

    let checkboxForm = useForm({
        hideNSFW: Boolean(settings.hideNSFW)
    })
</script>

<BlockHeader title="User Settings">
    <form on:submit|preventDefault>
        <div class="form-group">
            <label class="form-label">Status</label>
            <input class="form-input" value="{user.status}" bind:this={statusInput}>
            <button class="btn btn-primary" on:click={UpdateStatus}>Save</button>
        </div>
        <div class="form-group">
            <label class="form-label">Bio</label>
            <textarea class="form-input" bind:this={bioInput}>{user.bio}</textarea>
            <button class="btn btn-primary" on:click={UpdateBio}>Save</button>
        </div>

        <div class="form-group">
            <label class="form-checkbox">
                <input type="checkbox" bind:checked={$checkboxForm.hideNSFW}>
                <i class="form-icon"></i>
                Hide NSFW
            </label>
            <label class="form-checkbox">
                <input type="checkbox">
                <i class="form-icon"></i>
                This don't do nothing yet
            </label>
            <button class="btn btn-primary" on:click={()=>{$checkboxForm.post('/updateSettings')}}>Save</button>
        </div>
    </form>
</BlockHeader>
