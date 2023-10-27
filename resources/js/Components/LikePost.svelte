<script>
    import {LikePost, getLike} from "@/LikePost.ts";

    async function refreshLike()
    {
        liked = getLike(postid)
    }
    export let postid;
    let liked = getLike(postid)

</script>
{#await liked}
    <i>.</i>
{:then status}
    {#if status.liked === true}
        <i class="icon icon-upward c-hand bg-success" on:click={()=>{LikePost(postid); refreshLike()}}></i>
    {:else }
        <i class="icon icon-upward c-hand" on:click={()=>{LikePost(postid); refreshLike()}}></i>
    {/if}
{/await}
