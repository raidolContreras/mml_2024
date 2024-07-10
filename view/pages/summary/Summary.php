<style>
.collage-container {
    display: none;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: center; /* Centrar los elementos horizontalmente */
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    margin: 20px;
    animation: fadeIn 1s ease-in-out;
}

.collage-item {
    position: relative;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    background-color: #fff;
    margin: 10px;
    animation: scaleUp 0.5s ease-in-out;
}

.collage-item.small {
    width: 150px;
    height: 150px;
}

.collage-item.medium {
    width: 200px;
    height: 200px;
}

.collage-item.large {
    width: 250px;
    height: 250px;
}

.collage-item img,
.collage-item iframe {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.collage-item:hover {
    transform: scale(1.1);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
}

.file-icon {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #007bff;
    font-size: 30px;
    text-align: center;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.file-icon img {
    width: 50%;
    height: auto;
    max-height: 100%;
}

.file-icon:hover {
    transform: scale(1.2);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes scaleUp {
    from {
        transform: scale(0.8);
    }
    to {
        transform: scale(1);
    }
}

</style>

<div class="row mb-4 teamSelect">
    <div class="col-md-6 offset-md-3">
        <label for="teamSelectEdit" class="form-label teams"></label>
        <select class="form-select" id="teamSelectEdit">
        </select>
    </div>
</div>
<div id="collageContainer" class="collage-container">
</div>
