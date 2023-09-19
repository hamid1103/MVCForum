<script>
    import * as feather from "feather-icons/dist/feather.js"
    import SiteSettings from "@/Pages/Panels/SiteSettings.svelte";
    let currentPage='Home';
    export let frontpage;
    console.log(currentPage)
    function setPage(url = 'Home'){
        currentPage = url
    }
</script>

<div class="card">
    <div class="card-header">
        <div class="card-title h5 flex-centered">{currentPage}</div>
        <div class="btn-group btn-group-block">
            <button class="btn" on:click={setPage('Home')}>Home</button>
            <button class="btn" on:click={setPage('ServerSettings')}>Server Settings</button>
            <button class="btn" on:click={setPage('SiteSettings')}>Site Settings</button>
            <button class="btn">Roles</button>
            <button class="btn">Tags</button>
            <button class="btn">Categories</button>
            <button class="btn">Topics</button>
        </div>
    </div>
    <div class="card-body">
        {#if currentPage === "Home"}
            <div class="card">
                <div class="card-header">
                    <div class="card-title h5 text-bold">
                        Home
                    </div>
                </div>
                <div class="card-body">

                </div>
            </div>
            {:else if currentPage==="SiteSettings"}
            <SiteSettings {frontpage}></SiteSettings>
        {/if}
    </div>
</div>
