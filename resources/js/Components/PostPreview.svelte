<script>
    import {inertia, Link} from '@inertiajs/svelte'

    export let post;
    let prevtext = getText()

    function getText() {
        // search first paragraph
        let blocks = post.content.blocks
        let data = '';
        for (let i = 0; i < blocks.length; i++) {
            console.log('found block ')
            console.log(blocks[i])
            if (blocks[i].type == 'paragraph') {
                data = blocks[i].data.text;
                console.log('found ' + data)
                break;
            }
        }
        return data;
    }
</script>

<div class="card hover_effect" use:inertia="{{href: '/post/' + post.id, method: 'get'}}">
    <div class="card-body">
        <div class="tile">
            <div class="tile-content" style="width: 100%;">
                <div class="tile-title text-bold" style="width: 100%;">{post.name}</div>
                <div class="tile-subtitle"
                     style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap; width: 100%;">{prevtext}</div>
                {#if post.tags}
                    {#each post.tags as tag}
                        <span class="chip">{tag.name}</span>
                    {/each}
                {/if}
            </div>
        </div>
    </div>
</div>

<style>
    .hover_effect {
        background-color: white;
        color: black;
        transition: 200ms;
    }

    .hover_effect:hover {
        background-color: #3b4351;
        color: white;
        transition: 250ms;
    }
</style>
