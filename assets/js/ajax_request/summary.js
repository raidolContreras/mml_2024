
function getYouTubeID(url) {
    const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    const match = url.match(regExp);
    return (match && match[2].length === 11) ? match[2] : null;
}

function loadCollage() {
    $.ajax({
        url: 'controller/ajax/getReportFiles.php',
        method: 'POST',
        dataType: 'json',
        success: function (response) {
            const collageContainer = $('#collageContainer');
            collageContainer.empty();

            response.forEach(file => {
                let fileElement;
                if (file.type === 'image') {
                    fileElement = `
                        <div class="collage-item">
                            <img src="${file.path}" alt="${file.name}" class="img-fluid">
                        </div>`;
                } else if (file.type === 'video') {
                    const videoID = getYouTubeID(file.path);
                    fileElement = `
                        <div class="collage-item">
                            <iframe width="100%" height="200" src="https://www.youtube.com/embed/${videoID}" frameborder="0" allowfullscreen></iframe>
                        </div>`;
                } else {
                    fileElement = `
                        <div class="collage-item">
                            <a href="${file.path}" target="_blank">${file.name}</a>
                        </div>`;
                }
                collageContainer.append(fileElement);
            });
        },
        error: function (error) {
            console.error('Error al obtener los archivos del reporte:', error);
        }
    });
}

$(document).ready(function() {
    loadCollage();
});