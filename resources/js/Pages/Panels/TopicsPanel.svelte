<script>
    import AdminHomePanel from "@/Layout/AdminHomePanel.svelte";
    import {useForm} from "@inertiajs/svelte";

    export let topics;
    console.log(topics)
    let TopicForm = useForm({
        name: '',
        category: '',
        description: '',
        isNSFW: false
    })
    let currentCat = {name: 'unselected'};

    async function getCats(s = '') {
        const response = await fetch("/getCats/" + s);
        let data = await response.json();
        console.log(data)
        return data
    }

    let CatsPromise = getCats()
    let CatSearch = ''

    function handleTagInput() {
        CatsPromise = getCats(CatSearch)
    }

</script>

<AdminHomePanel></AdminHomePanel>

<div class="card">
    <div class="card-header">
        <div class="card-title h5 text-center">Topics Management</div>
        <div class="card-subtitle text-italic text-center">creating: {currentCat.name} -> {$TopicForm.name}</div>
    </div>
    <div class="card-header flex-centered">
        <form on:submit|preventDefault={handleTagInput}>
            <input class="form-input" type="text" id="input-example-1" bind:value={$TopicForm.name} placeholder="New Topic Name">
            <div class="popover popover-right">
                <input class="form-input" type="text" id="input-example-1" bind:value={CatSearch} placeholder="Search Categories">
                <div class="popover-container">
                    <div class="card">
                        <div class="card-body">
                            {#await CatsPromise}
                                <p>...waiting</p>
                            {:then tags}
                                {#each tags as tag}
                                    <span class="chip c-hand" on:click={()=>{currentCat = tag; $TopicForm.category = tag.id}}>{tag.name}</span>
                                {/each}
                            {:catch error}
                                <p style="color: red">{error.message}</p>
                            {/await}

                        </div>
                    </div>
                </div>
            </div>
            <input class="form-input" bind:value={$TopicForm.description} placeholder="Description">
            <div class="form-group">
                <label class="form-switch">
                    <input type="checkbox" bind:value={$TopicForm.isNSFW}>
                    <i class="form-icon"></i> is NSFW
                </label>
            </div>
        </form>
        <button class="btn btn-primary" on:click={()=>{$TopicForm.post('/createTopic')}}>Create Topic</button>

    </div>
    <div class="card-body flex-centered">
        <div>
            <table>
                <thead>
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Category</td>
                    <td>Desc</td>
                </tr>
                </thead>
                <tbody>
                {#each topics as topic}
                    <tr>
                        <td>{topic.id}</td>
                        <td>{topic.name}</td>
                        <td>{topic.category.name}</td>
                        <div class="popover popover-right">
                            <td class="sd">{topic.description}</td>
                            <div class="popover-container">
                                <div class="card">
                                    <div class="card-body">
                                        {topic.description}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                {/each}
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .sd {
        white-space: nowrap;
        max-width: 3rem;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
