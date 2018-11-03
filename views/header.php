<?php namespace views; ?>
<div class="header-icons">
                    <?php
                    if(!isset($_SESSION['status']))
                        {
                            include("navnotlog.php");

                        }
                        elseif($_SESSION['status']=='on')
                        {
                            $user=$_SESSION['logued'];
                            ?>
                                <p> <?php  echo $user->getName(); ?></p>
                                 <span class="linedivide1"></span>
                                <?php
                                    if ($_SESSION['logued']->getRol()== 'admin')
                                    { ?>
                                        <div class="btn-group">

                                                <button type="button" class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="<?= URl ?>images/icons/menuicon.png" alt="">
                                                </button>

                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?= URl ?>Artist">Agregar Artista</a>
                                                <a class="dropdown-item" href="<?= URl ?>Category/index">Agregar Categoria</a>
                                                <a class="dropdown-item" href="<?= URl ?>Place/index">Agregar Lugar de Evento</a>
                                                <a class="dropdown-item" href="<?= URl ?>Seat/index">Agregar Tipo de Plaza</a>
                                                <a class="dropdown-item" href="<?= URl ?>EventPlace/index">Agregar Plaza</a>
                                                <a class="dropdown-item" href="<?= URl ?>Event/index">Agregar Evento</a>
                                                <a class="dropdown-item" href="<?= URl ?>Calendar/index">Agregar Calendario</a>
                                            </div>
                                        </div>
                                        <span class="linedivide1"></span>
                                 <?php
                               } else { include("headercart.php");?>
                                <span class="linedivide1"></span>
                              <?php } ?>
                                  <form action="<?= URl ?>User/logout" method="post" >
                                        <button type="submit" name="cs"><p>Cerrar Sesion</p></button>
                                  </form>
                        <?php } ?>
                     </div>
				</div>
