import axios from "axios";

export async function LikePost(postid: string){
    let formd = new FormData
    formd.set('postid', postid)
    let data = await axios.post('/likePost', formd)
        .then((response)=>{
            console.log(response)
            return true
        })
        .catch(function (error){
            console.log(error)
            return false
        })
    return data
}

export async function getLike(postid:string)
{
    const response = await fetch("/getLike/" + postid);
    let data = await response.json();
    console.log(data)
    return data
}
