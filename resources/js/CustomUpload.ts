import axios from "axios";

export async function uploadByFile(file){
    let formd = new FormData
    console.log(file)
    formd.set('file', file)
    formd.set('filename', file.name)
    let data = await axios.post('/PostImageUpload', formd)
        .then((response)=>{
            console.log(response.data)
            return {
                "success" : 1,
                "file": {
                    "url": response.data.file
                }
            }
        })
        .catch(function (error){
            console.log(error)
        })
    return data
}
