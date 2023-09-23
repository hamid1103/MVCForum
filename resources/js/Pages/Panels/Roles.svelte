<script context="module">
    import DefaultLayout from "@/Layout/DefaultLayout.svelte";
    import AdminHomePanel from "@/Layout/AdminHomePanel.svelte";

    export const layout = [DefaultLayout, AdminHomePanel]
</script>
<script>
    export let users;

    console.log(users)
</script>

<div class="card">
    <div class="card-header">
        <div class="card-title h5 text-center">
            Roles
        </div>
        <div class="card-subtitle text-center">
            Assign roles to users
        </div>
    </div>
    <div class="card-body">

        <div class="s-rounded userHolder">

        </div>

    </div>
</div>
<style>
    .userHolder {
        overflow-y: auto;
        max-height: 70%;
    }
</style>
