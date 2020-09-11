            <!-- Page header -->
            <div class="full-box page-header">
                <h3 class="text-left">
                    <i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR MANTENIMIENTO
                </h3>
                <p class="text-justify">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum delectus eos enim numquam fugit optio accusantium, aperiam eius facere architecto facilis quibusdam asperiores veniam omnis saepe est et, quod obcaecati.
                </p>
            </div>

            <?php include_once "./vistas/inc/mantenimiento-head.php" ?>
            
            <!--CONTENT-->
            <div class="container-fluid">
                <form class="form-neon" action="">
                    <div class="container-fluid">
                        <div class="row justify-content-md-center">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="inputSearch" class="bmd-label-floating">¿Qué item estas buscando?</label>
                                    <input type="text" class="form-control" name="busqueda-" id="inputSearch" maxlength="30">
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="text-center" style="margin-top: 40px;">
                                    <button type="submit" class="btn btn-raised btn-info"><i class="fas fa-search"></i> &nbsp; BUSCAR</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="container-fluid">
                <form action="">
                    <input type="hidden" name="eliminar-busqueda" value="eliminar">
                    <div class="container-fluid">
                        <div class="row justify-content-md-center">
                            <div class="col-12 col-md-6">
                                <p class="text-center" style="font-size: 20px;">
                                    Resultados de la busqueda <strong>“Buscar”</strong>
                                </p>
                            </div>
                            <div class="col-12">
                                <p class="text-center" style="margin-top: 20px;">
                                    <button type="submit" class="btn btn-raised btn-danger"><i class="far fa-trash-alt"></i> &nbsp; ELIMINAR BÚSQUEDA</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-dark table-sm">
                        <thead>
                        <tr class="text-center roboto-medium">
                    <th>ID</th>
                    <th>ASUNTO</th>
                    <th>FECHA</th>
                    <th>ESTADO</th>
                    <th>USUARIO</th>
                    <th>EQUIPO</th>
                    <th>ACTUALIZAR</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center" >
                    <td>1</td>
                    <td>Reparación disco</td>
                    <td>20/09/2020</td>
                    <td>Pendiente</td>
                    <td>3</td>
                    <td>4</td>
                   
                    <td>
                        <a href="item-update.html" class="btn btn-success">
                            <i class="fas fa-sync-alt"></i> 
                        </a>
                    </td>
                    <td>
                        <form action="">
                            <button type="button" class="btn btn-warning">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <tr class="text-center" >
                    <td>1</td>
                    <td>Reparación disco</td>
                    <td>20/09/2020</td>
                    <td>Pendiente</td>
                    <td>3</td>
                    <td>4</td>
                   
                    <td>
                        <a href="item-update.html" class="btn btn-success">
                            <i class="fas fa-sync-alt"></i> 
                        </a>
                    </td>
                    <td>
                        <form action="">
                            <button type="button" class="btn btn-warning">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr> <tr class="text-center" >
                    <td>1</td>
                    <td>Reparación disco</td>
                    <td>20/09/2020</td>
                    <td>Pendiente</td>
                    <td>3</td>
                    <td>4</td>
                   
                    <td>
                        <a href="item-update.html" class="btn btn-success">
                            <i class="fas fa-sync-alt"></i> 
                        </a>
                    </td>
                    <td>
                        <form action="">
                            <button type="button" class="btn btn-warning">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr> <tr class="text-center" >
                    <td>1</td>
                    <td>Reparación disco</td>
                    <td>20/09/2020</td>
                    <td>Pendiente</td>
                    <td>3</td>
                    <td>4</td>
                   
                    <td>
                        <a href="item-update.html" class="btn btn-success">
                            <i class="fas fa-sync-alt"></i> 
                        </a>
                    </td>
                    <td>
                        <form action="">
                            <button type="button" class="btn btn-warning">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                        </tbody>
                    </table>
				</div>
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center">
						<li class="page-item disabled">
							<a class="page-link" href="#" tabindex="-1">Previous</a>
						</li>
						<li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item">
							<a class="page-link" href="#">Next</a>
						</li>
					</ul>
				</nav>
			</div>