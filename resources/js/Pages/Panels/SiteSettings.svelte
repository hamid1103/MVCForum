<script>
    import EditorJS from "@editorjs/editorjs";
    import Header from "@editorjs/header";
    //import SimpleImage from "@editorjs/simple-image";
    import ImageTool from '@editorjs/image';
    import {useForm, page} from "@inertiajs/svelte";
    import AdminHomePanel from "@/Layout/AdminHomePanel.svelte";
    import {uploadByFile} from "@/CustomUpload.ts";

    export let frontpage;

    let editor;
    if(frontpage === 404){
        editor = new EditorJS({
            tools: {
                header: {
                    class: Header,
                    config: {
                        placeholder: 'header',
                        levels: [2, 3, 4],
                        defaultLevel: 2
                    }
                },
                image: ImageTool
            }
        })
    }else {
        editor = new EditorJS({
            tools: {
                header: {
                    class: Header,
                    config: {
                        placeholder: 'header',
                        levels: [2, 3, 4],
                        defaultLevel: 2
                    }
                },
                image: {
                    class: ImageTool,
                    config: {
                        endpoints: {
                            byFile: '/PostImageUpload', // Your backend file uploader endpoint
                            byUrl: 'http://127.0.0.1:8000/PostImageURL', // Your endpoint that provides uploading by Url
                        },
                        uploader: {
                            uploadByFile: uploadByFile,
                        }
                    }
                }
            },
            data: JSON.parse(frontpage)
        })
    }

    let saveCont = useForm({
        PostContent: ''
    })

    async function SaveContent() {
        const data = await editor.save()
        $saveCont.PostContent = data
        $saveCont.post('/updateFrontPage');
    }

</script>

<AdminHomePanel></AdminHomePanel>

<div class="card">
    <div class="card-header">
        <div class="card-title h5 text-center">Homepage Content</div>
    </div>
    <div class="card-body">
        <div class="editorholder s-rounded" id="editorjs"></div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary" on:click={SaveContent}>Save</button>
    </div>
</div>

<style>
    .editorholder{
        border: black solid 1px;
    }
</style>
