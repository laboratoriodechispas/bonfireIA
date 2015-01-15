<div class="admin-box">
    <h3>Blog Posts</h3>

    <?php echo form_open(); ?>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Pagado</th>
            <th style="width: 10em">Fecha de inscripcion</th>
        </tr>
        </thead>
        <tfoot>

        </tfoot>
        <tbody>
        <?php if (isset($inscritos) && is_array($inscritos)) :

            ?>
            <?php foreach ($inscritos as $inscrito) : ?>
                <tr>

                    <td>
                       <?php echo $inscrito->nombre.' '.$inscrito->apellido_paterno.' '.$inscrito->apellido_materno; ?>
                    </td>
                    <td>
                        <?php echo $inscrito->email; ?>
                    </td>
                    <td>
                        <?php echo ($inscrito->status)?'si':'no'; ?>
                    </td>
                    <td>
                        <?php echo $inscrito->fecha_inscripcion; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        <?php else : ?>
            <div class="alert alert-info">
                No Posts were found.
            </div>
        <?php endif; ?>

        </tbody>
    </table>

    <?php echo form_close(); ?>
</div>

