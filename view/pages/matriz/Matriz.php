<style>
    .row {
        margin-bottom: 7px;
        margin-top: 7px;
        display: flex;
        align-items: center;
    }
    .col {
        padding: 15px;
        text-align: center;
    }
    .col-body {
        background: #fff;
        font-size: 14px;
        border-radius: 8px;
        margin: 5px;
        padding: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .col-body:hover {
        background-color: #e2e6ea;
        color: #007bff;
        cursor: pointer;
    }
    .head {
        background-color: #007bff;
        color: white;
        font-weight: bold;
        border-radius: 8px;
        text-align: center;
    }
    .row-body {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 10px;
        padding: 10px;
    }
    select.form-select {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ced4da;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .matrix {
        display: none;
    }
</style>
<div class="row mb-4">
    <div class="col-md-6 offset-md-3">
        <label for="teamSelectEdit" class="form-label">Select Team</label>
        <select class="form-select" id="teamSelectEdit"></select>
    </div>
</div>

<div class="container matrix">
    <div class="row head">
        <div class="col-2 product"></div>
        <div class="col-10">
            <div class="row">
                <div class="col activity"></div>
                <div class="col narrative_summary"></div>
                <div class="col indicator"></div>
                <div class="col goal"></div>
                <div class="col verification_sources"></div>
                <div class="col risks"></div>
                <div class="col start_date"></div>
                <div class="col term_date"></div>
            </div>
        </div>
    </div>
    <div class="row row-body">
        <div class="col-2 p-3">Producto-a</div>
        <div class="col-10">
            <div class="row" onclick="editMatriz()">
                <div class="col" id="activity_a01">Actividad-1</div>
                <div class="col col-body" id="">Resumen narrativo-1</div>
                <div class="col col-body" id="">Indicador-1</div>
                <div class="col col-body" id="">Meta-1</div>
                <div class="col col-body" id="">Fuentes de verificación-1</div>
                <div class="col col-body" id="">Riesgos-1</div>
                <div class="col col-body" id="">Fecha de inicio-1</div>
                <div class="col col-body" id="">Fecha de término-1</div>
            </div>
            <div class="row" onclick="editMatriz()">
                <div class="col" id="activity_a02">Actividad-2</div>
                <div class="col col-body" id="">Resumen narrativo-2</div>
                <div class="col col-body" id="">Indicador-2</div>
                <div class="col col-body" id="">Meta-2</div>
                <div class="col col-body" id="">Fuentes de verificación-2</div>
                <div class="col col-body" id="">Riesgos-2</div>
                <div class="col col-body" id="">Fecha de inicio-2</div>
                <div class="col col-body" id="">Fecha de término-2</div>
            </div>
            <div class="row" onclick="editMatriz()">
                <div class="col" id="activity_a03">Actividad-3</div>
                <div class="col col-body" id="">Resumen narrativo-3</div>
                <div class="col col-body" id="">Indicador-3</div>
                <div class="col col-body" id="">Meta-3</div>
                <div class="col col-body" id="">Fuentes de verificación-3</div>
                <div class="col col-body" id="">Riesgos-3</div>
                <div class="col col-body" id="">Fecha de inicio-3</div>
                <div class="col col-body" id="">Fecha de término-3</div>
            </div>
            <div class="row" onclick="editMatriz()">
                <div class="col" id="activity_a04">Actividad-4</div>
                <div class="col col-body" id="">Resumen narrativo-4</div>
                <div class="col col-body" id="">Indicador-4</div>
                <div class="col col-body" id="">Meta-4</div>
                <div class="col col-body" id="">Fuentes de verificación-4</div>
                <div class="col col-body" id="">Riesgos-4</div>
                <div class="col col-body" id="">Fecha de inicio-4</div>
                <div class="col col-body" id="">Fecha de término-4</div>
            </div>
        </div>
    </div>
    <div class="row row-body">
        <div class="col-2 p-3">Producto-b</div>
        <div class="col-10">
            <div class="row" onclick="editMatriz()">
                <div class="col" id="activity_b01">Actividad-1</div>
                <div class="col col-body" id="">Resumen narrativo-1</div>
                <div class="col col-body" id="">Indicador-1</div>
                <div class="col col-body" id="">Meta-1</div>
                <div class="col col-body" id="">Fuentes de verificación-1</div>
                <div class="col col-body" id="">Riesgos-1</div>
                <div class="col col-body" id="">Fecha de inicio-1</div>
                <div class="col col-body" id="">Fecha de término-1</div>
            </div>
            <div class="row" onclick="editMatriz()">
                <div class="col" id="activity_b02">Actividad-2</div>
                <div class="col col-body" id="">Resumen narrativo-2</div>
                <div class="col col-body" id="">Indicador-2</div>
                <div class="col col-body" id="">Meta-2</div>
                <div class="col col-body" id="">Fuentes de verificación-2</div>
                <div class="col col-body" id="">Riesgos-2</div>
                <div class="col col-body" id="">Fecha de inicio-2</div>
                <div class="col col-body" id="">Fecha de término-2</div>
            </div>
            <div class="row" onclick="editMatriz()">
                <div class="col" id="activity_b03">Actividad-3</div>
                <div class="col col-body" id="">Resumen narrativo-3</div>
                <div class="col col-body" id="">Indicador-3</div>
                <div class="col col-body" id="">Meta-3</div>
                <div class="col col-body" id="">Fuentes de verificación-3</div>
                <div class="col col-body" id="">Riesgos-3</div>
                <div class="col col-body" id="">Fecha de inicio-3</div>
                <div class="col col-body" id="">Fecha de término-3</div>
            </div>
            <div class="row" onclick="editMatriz()">
                <div class="col" id="activity_b04">Actividad-4</div>
                <div class="col col-body" id="">Resumen narrativo-4</div>
                <div class="col col-body" id="">Indicador-4</div>
                <div class="col col-body" id="">Meta-4</div>
                <div class="col col-body" id="">Fuentes de verificación-4</div>
                <div class="col col-body" id="">Riesgos-4</div>
                <div class="col col-body" id="">Fecha de inicio-4</div>
                <div class="col col-body" id="">Fecha de término-4</div>
            </div>
        </div>
    </div>
</div>
