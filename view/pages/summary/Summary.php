<style>
    <style>
    .collage-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
    }

    .collage-item {
        position: relative;
        width: 200px;
        margin: 10px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        background-color: #fff;
    }

    .collage-item img,
    .collage-item iframe {
        width: 100%;
        height: auto;
    }

    .collage-item:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
</style>

</style>
<div id="collageContainer" class="collage-container">
</div>
