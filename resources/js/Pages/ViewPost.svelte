<script>
    import BlockHeader from "@/Components/BlockHeader.svelte";
    import PostView from "@/Components/PostView.svelte";
    import {page} from "@inertiajs/svelte";
    import MakePost from "@/Pages/MakePost.svelte";
    import MakeReply from "@/Components/MakeReply.svelte";

    export let post;
    console.log(post)
</script>
<svelte:head>
    <title>{post.name}</title>
</svelte:head>
<div class="div1 container grid-lg" style="overflow-y: auto;">
    <div class="columns">
        <div class="column col-sm-6">
            <PostView title="{post.name}">
                <div class="card-body">
                    {#each post.content.blocks as block}
                        {#if block.type == 'header'}
                            <p class="h{block.data.level}">{@html block.data.text}</p>
                        {:else if block.type == 'paragraph'}
                            <p>{@html block.data.text}</p>
                        {:else if block.type == 'image'}
                            <img src="{block.data.url}" alt="{block.data.caption}" class="img img-responsive">
                        {/if}
                    {/each}
                </div>
                <div class="card-footer bg-dark p-1">
                    <div class="columns ">
                        <div class="column col-3">
                            <i class="icon icon-upward"></i>
                            <i class="icon icon-downward"></i>
                        </div>
                        <div class="column col-6">

                        </div>
                        <div class="column col-3 text-right">
                            {#if $page.props.auth.user !== null && $page.props.auth.user.id === post.user_id}
                                <i class="icon icon-edit"></i>
                            {/if}
                            <i class="icon icon-bookmark"></i>
                        </div>
                    </div>
                </div>
            </PostView>
            <!--Replies here-->
            <MakeReply></MakeReply>


        </div>
    </div>
</div>

<style>
    .icon {
        transition-duration: 200ms;
    }

    .icon:hover {
        transition-duration: 200ms;
        background-color: #505c6e;

    }

    .div1 {
        height: 100%
    }

    .div1::-webkit-scrollbar {
        width: 8px;
    }

    .div1::-webkit-scrollbar-track {
        box-shadow: inset 0 0 6px rgba(25, 0, 0, 0.3);
    }

    .div1::-webkit-scrollbar-thumb {
        background-color: darkgray;
        border-radius: 10px;
    }

</style>
