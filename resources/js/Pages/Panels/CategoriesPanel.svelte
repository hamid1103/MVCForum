<script>
    import AdminHomePanel from "@/Layout/AdminHomePanel.svelte";
    import {useForm} from "@inertiajs/svelte";

    export let categories;
    console.log(categories)

    let newCatForm = useForm({
        name: ''
    });

    function makeCat() {
        $newCatForm.post('/makeCat');
    }
</script>
<AdminHomePanel></AdminHomePanel>
<div class="card">
    <div class="card-header">
        <div class="card-title h5 text-center">Category Management</div>
    </div>
    <div class="card-body flex-centered">
        <div>
            <form on:submit|preventDefault class="form">
                <div class="form-group flex-centered">
                    <input bind:value={$newCatForm.name}>
                    <button class="btn btn-primary" on:click={makeCat}>+</button>
                </div>
            </form>
            <div class="s-rounded bg-gray">
                {#each categories as cat}
                    <div class="s-rounded bg-dark">{cat.name}</div>
                {/each}
            </div>
        </div>
    </div>
</div>
