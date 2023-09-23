<script context="module">
    import DefaultLayout from "@/Layout/DefaultLayout.svelte";
    import AdminHomePanel from "@/Layout/AdminHomePanel.svelte";

    export const layout = [DefaultLayout, AdminHomePanel]
</script>
<script>
    import {useForm} from "@inertiajs/svelte";

    export let tags;
    console.log(tags)

    let newTagForm = useForm({
        name: ''
    });
    function makeTag(){
        $newTagForm.post('/makeTag');
    }

</script>
<div class="card">
    <div class="card-header">
        <div class="card-title h5 text-center">Tags Management</div>
    </div>
    <div class="card-body flex-centered">
        <div>
            <form on:submit|preventDefault class="form">
                <div class="form-group flex-centered">
                    <input bind:value={$newTagForm.name}>
                    <button class="btn btn-primary" on:click={makeTag}>+</button>
                </div>
            </form>
            <div class="s-rounded bg-gray">
                {#each tags as tag}
                    <span class="chip">{tag.name}</span>
                {/each}
            </div>
        </div>
    </div>
</div>
