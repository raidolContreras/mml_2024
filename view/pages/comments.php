
<!-- Modal para agregar comentarios -->
<div class="card container my-5 p-3 CommentsList">
    <h6 id="Comment_Title"></h6>
    <div id="commentsList" class="row" style="justify-content: center;">
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="commetModal" tabindex="-1" aria-labelledby="treeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title commetTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="commentText" class="form-label Comment">Comentario</label>
                    <textarea class="form-control" id="commentText" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="editButton" onclick="addComment()"></button>
            </div>
        </div>
    </div>
</div>