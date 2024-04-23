<div class="conteiner">
    <div class="card">
        <div class="card-header">
            <div class="header-title d-flex justify-content-between">
                <h4 class="card-title event_list"></h4>
                <button class="btn btn-primary addEvent_btn" data-bs-toggle="modal" data-bs-target="#eventModal"></button>
            </div>
        </div>
        <div class="card-body">
            <table class="table" id="eventSettings">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="eventName"></th>
                        <th width="10%" class="actions"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Add users -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title addEvent_btn" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Nombre del proyecto -->
                <div class="form-group mt-3">
                    <label for="eventName" class="form-label eventName"></label>
                    <input type="text" class="form-control" id="eventName">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="sendButton"></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="eventModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title editTeam_btn" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Nombre del proyecto -->
                <div class="form-group mt-3">
                    <label for="eventNameEdit" class="form-label eventName"></label>
                    <input type="text" class="form-control" id="eventNameEdit">
                </div>
                <input type="hidden" id="eventEdit">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="editButton"></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteEventModal" tabindex="-1" aria-labelledby="deleteEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title alert-message" id="deleteEventModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="deleteMessage">

                </div>
            </div>
            <input type="hidden" id="deleteEvent">
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success acceptDelete" id="deleteButton"></button>
            </div>
        </div>
    </div>
</div>