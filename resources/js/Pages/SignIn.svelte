<script>

import BlockHeader from "@/Components/BlockHeader.svelte";
import { useForm } from '@inertiajs/svelte'

let form = useForm({
    email: null,
    password: null,
    remember: false,
})

let RegForm = useForm({
    email: null,
    password: null,
    name: null
})
function registerSubmit(){
    if (error !== '') {
        return;
    }
    $RegForm.post('/register')
}

let pw2;
let error = '';

function checkMatch() {
    console.log(pw2 + ' | ' + $RegForm.password)
    if (pw2 !== $RegForm.password) {
        error = "Passwords don't match"
    } else {
        error = ''
    }
}

function submit() {

    $form.post('/signin')
}

</script>
<div class="container">

    <div class="columns">
        <div class="column col-12">
            <BlockHeader title="sign-in">
                <div class="columns">
                    <div class="column">

                        <form on:submit|preventDefault={submit}>
                            <div class="form-group">
                                <label class="form-label" for="input-example-1">Email</label>
                                <input class="form-input" id="input-example-1" required type="text" bind:value={$form.email} placeholder="Email">
                                {#if $form.errors.email}
                                    <div class="form-error bg-error">{$form.errors.email}</div>
                                {/if}
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="input-example-2">Password</label>
                                <input class="form-input" id="input-example-2" type="password" required placeholder="Password" bind:value={$form.password}>
                            </div>
                            <div class="form-group">
                                <label class="form-checkbox">
                                    <input type="checkbox" bind:checked={$form.remember}><i class="form-icon"></i> Remember me
                                </label>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" disabled={$form.processing}>Sign in</button>
                            </div>
                        </form>

                    </div>
                    <div class="divider-vert" data-content="OR"></div>
                    <div class="column">

                        <form on:submit|preventDefault={registerSubmit}>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input class="form-input" type="text" placeholder="Email" required bind:value={$RegForm.email}>
                            </div>

                            <div class="form-group">
                                <label class="form-label" >Username</label>
                                <input class="form-input" type="text" placeholder="Username" required bind:value={$RegForm.name}>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input class="form-input" type="password" required bind:value={$RegForm.password}>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Repeat Password</label>
                                <input class="form-input" type="password" required bind:value={pw2} on:keyup={checkMatch} on:change={checkMatch}>
                                {#if error !== ''}
                                    <div class="bg-error">{error}</div>
                                {/if}
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary btn-block" disabled={$RegForm.processing}>Sign up</button>
                            </div>
                        </form>

                    </div>
                </div>
            </BlockHeader>
        </div>
    </div>
</div>
