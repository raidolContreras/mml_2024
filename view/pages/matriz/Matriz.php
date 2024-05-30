
    <style>
        .container {
            width: 100%;
            overflow-x: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2, p {
            text-align: center;
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 12px;
            overflow: visible;
            white-space: pre-line;
        }
        th {
            background-color: #007BFF;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        th.producto, td.producto {
            width: 10%;
        }
        th.actividad, td.actividad {
            width: 20%;
        }
        th.resumen, td.resumen {
            width: 20%;
        }
        th.indicador, td.indicador {
            width: 20%;
        }
        th.meta, td.meta {
            width: 5%;
        }
        th.fuentes, td.fuentes {
            width: 10%;
        }
        th.riesgos, td.riesgos {
            width: 10%;
        }
        th.fecha-inicio, td.fecha-inicio,
        th.fecha-termino, td.fecha-termino {
            width: 5%;
        }
        @media (max-width: 600px) {
            table, th, td {
                display: block;
                width: 100%;
            }
            th, td {
                box-sizing: border-box;
            }
            tr {
                margin-bottom: 1rem;
                display: block;
                border-bottom: 2px solid #000;
            }
            th {
                background-color: #007BFF;
                color: white;
                display: block;
                text-align: right;
                padding-right: 10px;
            }
            td {
                display: block;
                text-align: right;
                padding-left: 50%;
                position: relative;
            }
        }
        
    </style>
    
    <div class="row mb-4">
        <div class="col-md-6 offset-md-3">
            <label for="teamSelectEdit" class="form-label teams">Select Team</label>
            <select class="form-select" id="teamSelectEdit">
            </select>
        </div>
    </div>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th class="producto">Producto</th>
                    <th class="actividad">Actividad</th>
                    <th class="resumen">Resumen narrativo</th>
                    <th class="indicador">Indicador</th>
                    <th class="meta">Meta</th>
                    <th class="fuentes">Fuentes de verificación</th>
                    <th class="riesgos">Riesgos</th>
                    <th class="fecha-inicio">Fecha de inicio</th>
                    <th class="fecha-termino">Fecha de término</th>
                </tr>
            </thead>
            <tbody>
                <tr class="a">
                    <td rowspan="4" class="producto product-a" data-label="Producto">Implement rainwater collection systems in our community.</td>
                    <td class="actividad" data-label="Actividad">Build healthy gardens with the help of our schools’ students.</td>
                    <td class="resumen" data-label="Resumen narrativo">We will build a garden structure in where we are going to cultivate our vegetables with the help of Conalep students</td>
                    <td class="indicador" data-label="Indicador">Número de students que will participate in the building of the garden</td>
                    <td class="meta" data-label="Meta">25</td>
                    <td class="fuentes" data-label="Fuentes de verificación">Fotos, Videos</td>
                    <td class="riesgos" data-label="Riesgos">It is a hard work for the students, so they will be annoyed sometimes</td>
                    <td class="fecha-inicio" data-label="Fecha de inicio">2023-12-04</td>
                    <td class="fecha-termino" data-label="Fecha de término">2024-01-20</td>
                </tr>
                <tr class="a">
                    <td class="actividad" data-label="Actividad">Place rainwater collection in our schools’</td>
                    <td class="resumen" data-label="Resumen narrativo">We will build a small collect system of rain water in 3 schools of our municipality</td>
                    <td class="indicador" data-label="Indicador">Número de students que will participate in the building of the garden</td>
                    <td class="meta" data-label="Meta">25</td>
                    <td class="fuentes" data-label="Fuentes de verificación">Fotos, Videos</td>
                    <td class="riesgos" data-label="Riesgos">There is a hard work for the students during vacations, so they might be exhausted</td>
                    <td class="fecha-inicio" data-label="Fecha de inicio">2023-12-04</td>
                    <td class="fecha-termino" data-label="Fecha de término">2024-01-20</td>
                </tr>
                <tr class="a">
                    <td class="actividad" data-label="Actividad">Tutorial of how to do our rainwater collection systems.</td>
                    <td class="resumen" data-label="Resumen narrativo">We will record a video explaining how to do a collect of rain water system, and upload to our social media</td>
                    <td class="indicador" data-label="Indicador">Número de views que we will have in our social media</td>
                    <td class="meta" data-label="Meta">100</td>
                    <td class="fuentes" data-label="Fuentes de verificación">Videos</td>
                    <td class="riesgos" data-label="Riesgos">That the video won’t have a lot of views</td>
                    <td class="fecha-inicio" data-label="Fecha de inicio">2024-01-21</td>
                    <td class="fecha-termino" data-label="Fecha de término">2024-01-25</td>
                </tr>
                <tr class="a">
                    <td class="actividad" data-label="Actividad">Promote the water collection with the help of our town hall.</td>
                    <td class="resumen" data-label="Resumen narrativo">We will have a talk with the authorities of Tapalpa in where we will think about some strategies to implement Filtrando Vidas in more places</td>
                    <td class="indicador" data-label="Indicador">Número de meetings que we will have with the authorities</td>
                    <td class="meta" data-label="Meta">3</td>
                    <td class="fuentes" data-label="Fuentes de verificación">Reportes</td>
                    <td class="riesgos" data-label="Riesgos">That for being young people the authorities won’t take us seriously</td>
                    <td class="fecha-inicio" data-label="Fecha de inicio">2024-02-12</td>
                    <td class="fecha-termino" data-label="Fecha de término">2024-02-22</td>
                </tr>
                <tr class="b">
                    <td rowspan="4" class="producto product-b" data-label="Producto">Awareness campaign</td>
                    <td class="actividad" data-label="Actividad">Conferences about the good care of the water.</td>
                    <td class="resumen" data-label="Resumen narrativo">We are going to have conferences with young students to invite them to take care about the water, this with recreative activities</td>
                    <td class="indicador" data-label="Indicador">Número de students que attend the meetings</td>
                    <td class="meta" data-label="Meta">125</td>
                    <td class="fuentes" data-label="Fuentes de verificación">Fotos, Listas de asistencia</td>
                    <td class="riesgos" data-label="Riesgos">That we won’t complete the students attendance list</td>
                    <td class="fecha-inicio" data-label="Fecha de inicio">2024-02-15</td>
                    <td class="fecha-termino" data-label="Fecha de término">2024-02-29</td>
                </tr>
                <tr class="b">
                    <td class="actividad" data-label="Actividad">Teach students about sustainability with some workshop in their schools</td>
                    <td class="resumen" data-label="Resumen narrativo">We will expose a presentation about sustainability in the 3 schools</td>
                    <td class="indicador" data-label="Indicador">Número de students que attend the presentation</td>
                    <td class="meta" data-label="Meta">125</td>
                    <td class="fuentes" data-label="Fuentes de verificación">Fotos, Listas de asistencia</td>
                    <td class="riesgos" data-label="Riesgos">That the students won’t pay attention to our presentation</td>
                    <td class="fecha-inicio" data-label="Fecha de inicio">2024-01-15</td>
                    <td class="fecha-termino" data-label="Fecha de término">2024-01-29</td>
                </tr>
                <tr class="b">
                    <td class="actividad" data-label="Actividad">Social media post with responsible tips of how to give a different usage of water.</td>
                    <td class="resumen" data-label="Resumen narrativo">We will post some stories, fun fact post, pictures, and tutorials with some tips about the water care</td>
                    <td class="indicador" data-label="Indicador">Número de followers que we will have on our social media</td>
                    <td class="meta" data-label="Meta">300</td>
                    <td class="fuentes" data-label="Fuentes de verificación">Fotos</td>
                    <td class="riesgos" data-label="Riesgos">That we won’t have followers</td>
                    <td class="fecha-inicio" data-label="Fecha de inicio">2023-12-26</td>
                    <td class="fecha-termino" data-label="Fecha de término">2024-03-26</td>
                </tr>
                <tr class="b">
                    <td class="actividad" data-label="Actividad">Teach students how do they can contribute to our municipality with small actions with some recreational activities.</td>
                    <td class="resumen" data-label="Resumen narrativo">We will have monthly conferences with students, in where we will do a review of the main objective of our project with recreative activities</td>
                    <td class="indicador" data-label="Indicador">Número de students que attend the meetings</td>
                    <td class="meta" data-label="Meta">125</td>
                    <td class="fuentes" data-label="Fuentes de verificación">Fotos, Listas de asistencia</td>
                    <td class="riesgos" data-label="Riesgos">That the students might not attend the meeting</td>
                    <td class="fecha-inicio" data-label="Fecha de inicio">2024-02-20</td>
                    <td class="fecha-termino" data-label="Fecha de término">2024-04-20</td>
                </tr>
            </tbody>
        </table>
    </div>