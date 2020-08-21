<div class="row m-0">


    <div class="col-md-6 offset-md-3">

        <div class="card card-outline-secondary">
            <div class="card-header">
                <h2 class="mb-0"><?= the_title() ?></h2>
            </div>
            <div class="card-body">

                <form class="form" id="contactForm" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" role="form"
                      autocomplete="off" novalidate>


                    <div id="status" style="display: none;">

                    </div>


                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input id="name" name="name" type="text"
                               class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Assunto</label>
                        <input id="subject" name="subject" type="text"
                               class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email"
                               class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="text">Escreva para o Banco de Obras</label>
                        <textarea name="text" id="text"
                                  class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-banco btn-success btn-lg float-right"
                                id="sendEmail">Enviar
                        </button>
                    </div>

                </form>


            </div>
        </div>

    </div>

</div>

