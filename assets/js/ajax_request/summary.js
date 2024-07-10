var level = $('#level').val();
var team;
$(document).ready(function() {
    const Project = $('#project').val();
    
    if (level == 0) {
        $('#teamSelectEdit').on('change', function() {
            team = $('#teamSelectEdit').val();
            if (team >= 1) {
                loadCollage(Project, team);
                $('.collage-container').css('display', 'none');
            } else {
                $('.Comments').css('display', 'none');
                $('.collage-container').css('display', 'none');
            }
        });
    } else {
        var Team = (level == 1) ? level : $('#teamSelectEdit').val();
        loadCollage(Project, Team);
        $('.collage-container').css('display', 'flex');
    }
});

function getYouTubeID(url) {
    const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    const match = url.match(regExp);
    return (match && match[2].length === 11) ? match[2] : null;
}

function getFileIcon(fileName) {
    const extension = fileName.split('.').pop().toLowerCase();
    switch (extension) {
        case 'pdf':
            return 'assets/images/pdf-icon.png';
        case 'doc':
        case 'docx':
            return 'assets/images/word-icon.png';
        case 'ppt':
        case 'pptx':
            return 'assets/images/powerpoint-icon.png';
        case 'xls':
        case 'xlsx':
            return 'assets/images/excel-icon.png';
        case 'txt':
            return 'assets/images/text-icon.png';
        default:
            return 'assets/images/file-icon.png';
    }
}

function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

function loadCollage(Project, Team) {
    $.ajax({
        url: 'controller/ajax/getReportFiles.php',
        method: 'POST',
        data: { Project: Project, Team: Team},
        dataType: 'json',
        success: function (response) {
            const collageContainer = $('#collageContainer');
            collageContainer.empty();
            
            const sizes = ['small', 'medium', 'large'];
            shuffleArray(response);

            response.forEach(file => {
                const sizeClass = sizes[Math.floor(Math.random() * sizes.length)];
                let fileElement;
                if (file.type === 'image') {
                    fileElement = `
                        <div class="collage-item ${sizeClass}">
                            <img src="${file.path}" alt="${file.name}" class="img-fluid">
                        </div>`;
                } else if (file.type === 'video') {
                    const videoID = getYouTubeID(file.path);
                    fileElement = `
                        <div class="collage-item ${sizeClass}">
                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/${videoID}" frameborder="0" allowfullscreen></iframe>
                        </div>`;
                } else {
                    const fileIcon = getFileIcon(file.name);
                    fileElement = `
                        <div class="collage-item ${sizeClass}">
                            <a href="${file.path}" target="_blank" class="file-icon">
                                <img src="${fileIcon}" alt="${file.name}">
                            </a>
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
