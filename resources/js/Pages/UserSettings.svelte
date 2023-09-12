<script>
import BlockHeader from "@/Components/BlockHeader.svelte";
import {useForm} from "@inertiajs/svelte";
export let user;
export let settings;
settings = settings[0]
console.log([user, settings])

let HideNSFW =Boolean(settings.hideNSFW);

let bioInput;
let BioForm = useForm({
    bio: ''
})
function UpdateBio(){
    $BioForm.bio = bioInput.value
    $BioForm.post('/updateBio');
}

let statusInput;
let statusForm=useForm({

})


</script>

<BlockHeader title="User Settings">
    <form on:submit|preventDefault>
        <div class="form-group">
            <label class="form-label">Status</label>
            <input class="form-input" value="{user.status}" >
            <button class="btn btn-primary">Save</button>
        </div>
        <div class="form-group">
            <label class="form-label">Bio</label>
            <textarea class="form-input" bind:this={bioInput}>{user.bio}</textarea>
            <button class="btn btn-primary" on:click={UpdateBio}>Save</button>
        </div>

        <div class="form-group">
            <label class="form-label">Hide NSFW</label>
            <input type="checkbox" bind:checked={HideNSFW}>
        </div>
        <button class="btn btn-primary">Save</button>
    </form>
</BlockHeader>
