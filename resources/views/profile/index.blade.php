@extends('layouts.app')

@section('content')
    <div style="display: flex; align-items: center; gap: 1rem; margin-top: 1rem;">
        <p style="margin: 0;">Nama: {{ $user->full_name }}</p>
        <button id="namaButton" onclick="showForm('nama')"><i class="fa-regular fa-pen-to-square"></i></button>
    </div>

    <form 
        id="namaForm" method="POST" action="{{ route('profile.editValue') }}" 
        style="display: none; gap: 1rem; margin-top: .5rem;"
    >
        @csrf
        @method('PUT')
    </form>

    <div style="display: flex; align-items: center; gap: 1rem; margin-top: 1rem;">
        <p style="margin: 0;">Email: {{ $user->email }}</p>
        <button id="emailButton" onclick="showForm('email')"><i class="fa-regular fa-pen-to-square"></i></button>
    </div>

    <form 
        id="emailForm" method="POST" action="{{ route('profile.editValue') }}"
        style="display: none; gap: 1rem; margin-top: .5rem;"
    >
        @csrf
        @method('PUT')
    </form>

    <div style="display: flex; align-items: center; gap: 1rem; margin-top: 1rem;">
        <p style="margin: 0;">Password: 
            <input 
                type="password" value="abcdefghijklmn" disabled
                style="border: 0; opacity: 1; color: inherit;" 
            />
        </p>
        <button id="passwordButton" onclick="showForm('password')"><i class="fa-regular fa-pen-to-square"></i></button>
    </div>

    <form 
        id="passwordForm" method="POST" action="{{ route('profile.editValue') }}"
        style="display: none; gap: 1rem; margin-top: .5rem;"
    >
        @csrf
        @method('PUT')
    </form>

    @if(session('error'))
        <div style="margin-top: 2rem;">
            {{ session('error') }}
        </div>
    @endif

    <script>
        const cancelForm = (name) => {
            document.getElementById(`${name}Form`).style.display = "none";
            document.getElementById(`${name}Form`).innerHTML = "";
            document.getElementById(`${name}Button`).onclick = () => showForm(name);
        }
        
        const showForm = (name) => {
            formElement = document.getElementById(`${name}Form`);
            
            const typeInput = document.createElement('input');
            typeInput.type = "hidden";
            typeInput.name = "type";
            typeInput.value = name;

            if (name == "password"){
                const oldLabel = document.createElement('label');
                oldLabel.innerHTML = `${name.charAt(0).toUpperCase() + name.slice(1)} Saat Ini:`;
                const oldInput = document.createElement('input');
                oldInput.type = "password";
                oldInput.name = `current${name.charAt(0).toUpperCase() + name.slice(1)}`;
                oldInput.min = "8";
                
                const newLabel1 = document.createElement('label');
                newLabel1.innerHTML = `${name.charAt(0).toUpperCase() + name.slice(1)} Baru:`;
                const newInput1 = document.createElement('input');
                newInput1.type = "password";
                newInput1.name = `new${name.charAt(0).toUpperCase() + name.slice(1)}`;
                newInput1.min = "8";
                
                const newLabel2 = document.createElement('label');
                newLabel2.innerHTML = `Confirm ${name.charAt(0).toUpperCase() + name.slice(1)} Baru:`;
                const newInput2 = document.createElement('input');
                newInput2.type = "password";
                newInput2.name = `new${name.charAt(0).toUpperCase() + name.slice(1)}_confirmation`;
                newInput2.min = "8";

                const cancelButton = document.createElement('button');
                cancelButton.textContent = "Cancel";
                
                const saveButton = document.createElement('button');
                saveButton.textContent = "Save";

                formElement.append(
                    typeInput, 
                    oldLabel, oldInput,
                    newLabel1, newInput1,
                    newLabel2, newInput2,
                    cancelButton, saveButton
                );

                formElement.style.flexDirection = "column";
                formElement.style.maxWidth = "15rem";
            } else{
                const titleLabel = document.createElement('label');
                titleLabel.innerHTML = `${name.charAt(0).toUpperCase() + name.slice(1)} Baru:`;

                const titleInput = document.createElement('input');
                if (name == 'email'){
                    titleInput.type = "email";
                } else{
                    titleInput.type = "text";
                }
                titleInput.name = "value";
    
                const cancelButton = document.createElement('button');
                cancelButton.textContent = "Cancel";
                
                const saveButton = document.createElement('button');
                saveButton.textContent = "Save";
                saveButton.type = "submit"

                formElement.append(typeInput, titleLabel, titleInput, cancelButton, saveButton);
            }
            
            formElement.style.display = "flex";

            document.getElementById(`${name}Button`).onclick = () => cancelForm(name);
        }
    </script>
@endsection