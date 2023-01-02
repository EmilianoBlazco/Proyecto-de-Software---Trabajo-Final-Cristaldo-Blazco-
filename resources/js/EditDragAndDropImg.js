document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
  const dropZoneElement = inputElement.closest(".drop-zone");

  dropZoneElement.addEventListener("click", (e) => {
    if (!e.target.classList.contains("drop-zone__button")) {
      inputElement.click();
    } else {
      inputElement.value = null;
      dropZoneElement.querySelector(".drop-zone__thumb").remove();
      const newDropZonePrompt = document.createElement("span");
      newDropZonePrompt.classList.add("drop-zone__prompt");
      const newDropZoneIcon = document.createElement("i");
      newDropZoneIcon.classList.add("fa-solid", "fa-upload", "fa-2x");
      const newDropBr = document.createElement("br");
      const newDropZoneInput = document.createElement("input");
      newDropZoneInput.classList.add("drop-zone__input");
      newDropZoneInput.setAttribute("type", "file");
      newDropZoneInput.setAttribute("accept", "image/*");
      const newDropZonePromptText = document.createElement("span");
      newDropZonePromptText.classList.add("drop-zone__prompt");
      newDropZonePromptText.textContent = "Arrastra la foto de la propiedad";
      // si es el input con el nombre name="file" se debe agregar un div dentro del span
        if (inputElement.name === "file") {
            const newDropZoneDiv = document.createElement("h7");
            newDropZoneDiv.classList.add("drop-zone__principal");
            newDropZoneDiv.textContent = "Foto principal";
            newDropZonePrompt.appendChild(newDropZoneDiv);
        }
      dropZoneElement.appendChild(newDropZonePrompt);
      newDropZonePrompt.appendChild(newDropZoneIcon);
      newDropZonePrompt.appendChild(newDropBr);
      newDropZonePrompt.appendChild(newDropZoneInput);
      newDropZonePrompt.appendChild(newDropZonePromptText);
    }
  });

  inputElement.addEventListener("change", (e) => {
    if (inputElement.files.length) {
      updateThumbnail(dropZoneElement, inputElement.files[0]);
    }
  });

  dropZoneElement.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZoneElement.classList.add("drop-zone--over");
  });

  ["dragleave", "dragend"].forEach((type) => {
    dropZoneElement.addEventListener(type, (e) => {
      dropZoneElement.classList.remove("drop-zone--over");
    });
  });

  dropZoneElement.addEventListener("drop", (e) => {
    e.preventDefault();
    // Añade un nuevo input de tipo "file" a la página
    // addFileInput();
    if (e.dataTransfer.files.length) {
      inputElement.files = e.dataTransfer.files;
      updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
    }

    dropZoneElement.classList.remove("drop-zone--over");
  });
});

function updateThumbnail(dropZoneElement, file) {
  let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

  // First time - remove the prompt
  if (dropZoneElement.querySelector(".drop-zone__prompt")) {
    dropZoneElement.querySelector(".drop-zone__prompt").remove();
  }

  // First time - there is no thumbnail element, so lets create it
  if (!thumbnailElement) {
    thumbnailElement = document.createElement("div");
    thumbnailElement.classList.add("drop-zone__thumb");
    dropZoneElement.appendChild(thumbnailElement);
  }

      // thumbnailElement.dataset.label = file.name;


  // Show thumbnail for image files
  if (file.type.startsWith("image/")) {
    const reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onload = () => {
      thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
      //   si ya existe un botón de eliminar en el input actual, no lo vuelva a crear
      if (!dropZoneElement.querySelector(".drop-zone__button")) {
        const newButton = document.createElement("button");
        newButton.classList.add(
          "drop-zone__button",
          "fa-solid",
          "fa-xmark",
            "fa-3x"
        );
        thumbnailElement.appendChild(newButton);
      }
    };
  } else if (file.name === "")   {
    thumbnailElement.style.backgroundImage = `url('${file.attributes[0].value}')`;
  } else {
    thumbnailElement.style.backgroundImage = null;
  }

}

function cargarImagenesActuales() {
  // cargar los inputs con las imagenes actuales que están en la base de datos y en la carpeta storage
    const imagenesActuales = document.querySelectorAll(".imagenesActuales");
    imagenesActuales.forEach((imagenActual) => {

    });
}

// luego de iniciar la pantalla se carga la función cargarImagenesActuales() que carga las imagenes actuales en el input de tipo file
window.addEventListener("load", cargarImagenesActuales);
