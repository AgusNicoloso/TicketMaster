<?php  namespace views;
       use controllers\CalendarController;
use controllers\UserController;
use models\User;

$c_user=new UserController();
$c_calendar=new CalendarController();
?>
<div class="header-icons">
                    <?php
                    if($c_user->isFB()){
                        $c_user->setOnLog();
                        $user=new User($_SESSION['userData']['mail'],'',$_SESSION['userData']['mail'],'user');
                    }
                        if($c_user->islog())
                        {
                            if(empty($user)){
                                $user=$_SESSION['logued'];
                            }

                            ?>
                                <p> <?php  echo $user->getName(); ?></p>
                                 <span class="linedivide1"></span>
                                <?php
                                    if ($c_user->isAdmin($user))
                                    { ?>
                                        <div class="btn-group">

                                                <button type="button" class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="<?= URl ?>images/icons/menuicon.png" alt="">
                                                </button>

                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?= URl ?>Buy/index">Ver ventas</a>
                                                <a class="dropdown-item" href="<?= URl ?>Artist">Agregar Artista</a>
                                                <a class="dropdown-item" href="<?= URl ?>Category/index">Agregar Categoria</a>
                                                <a class="dropdown-item" href="<?= URl ?>Place/index">Agregar Lugar de Evento</a>
                                                <a class="dropdown-item" href="<?= URl ?>Seat/index">Agregar Tipo de Plaza</a>
                                                <a class="dropdown-item" href="<?= URl ?>Event/index">Agregar Calendario</a>
                                            </div>
                                        </div>
                                        <span class="linedivide1"></span>
                                 <?php
                               } else { ?>
                                <a href="buy/userbuylist"><img src="<?= URl ?>images/icons/billeteraicon.png" alt="" height="25px" width="25px"></a>
                                <span class="linedivide1"></span>
                                <?php include("headercart.php");?>
                                <span class="linedivide1"></span>
                              <?php } ?>
                                  <form action="<?= URl ?>User/logout" method="post" >
                                        <button type="submit" name="cs"><p>Cerrar Sesion</p></button>
                                  </form>
                        <?php }
                        else
                        {
                            include("navnotlog.php");

                        }

                        ?>
                     </div>
				</div>
