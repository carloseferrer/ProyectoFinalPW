<?php
require_once('tcpdf/tcpdf.php'); //Llamando a la Libreria TCPDF
require_once('connection.php'); //Llamando a la conexión para BD
date_default_timezone_set('America/Caracas');

if(isset($_POST['reportebtn'])){


    $resultado = $_POST['resultado'];
    $sql = "SELECT * FROM orden_compra";
    
    $run_Sql = mysqli_query($con, $sql);
    
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
    }

    if($resultado=="Abierta"){
        ob_end_clean(); //limpiar la memoria
    
        class MYPDF extends TCPDF{
              
                public function Header() {
                    $bMargin = $this->getBreakMargin();
                    $auto_page_break = $this->AutoPageBreak;
                    $this->SetAutoPageBreak(false, 0);
                    $img_file = dirname( __FILE__ ) .'/assets/img/limpiajpg.jpg';
                    $this->Image($img_file, 80, -3, 60, 60, 'JPG', '', '', false, 30, '', false, false, 0);
                    $this->SetAutoPageBreak($auto_page_break, $bMargin);
                    $this->setPageMark();
                }
        }

            //Iniciando un nuevo pdf
            $pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'mm', 'Letter', true, 'UTF-8', false);
     
            //Establecer margenes del PDF
            $pdf->SetMargins(20, 35, 25);
            $pdf->SetHeaderMargin(20);
            $pdf->setPrintFooter(false);
            $pdf->setPrintHeader(true); //Eliminar la linea superior del PDF por defecto
            $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM); //Activa o desactiva el modo de salto de página automático
     
            //Informacion del PDF
            $pdf->SetCreator('Casa Limpia');
            $pdf->SetAuthor('Casa Limpia');
            $pdf->SetTitle('Informe de Ordenes de Compra');

            $codigo = rand(999999, 111111);
    
            //Agregando la primera página
            $pdf->AddPage();
            $pdf->SetFont('helvetica','B',10); //Tipo de fuente y tamaño de letra
            $pdf->SetXY(150, 20);
            $pdf->Write(0, 'Código: '.'#'. $codigo);
            $pdf->SetXY(150, 25);
            $pdf->Write(0, 'Fecha: '. date('d-m-Y'));
            $pdf->SetXY(150, 30);
            $pdf->Write(0, 'Hora: '. date('h:i A'));
            
            $canal ='Casa Limpia Compañia Anónima';
            $pdf->SetFont('helvetica','B',10); //Tipo de fuente y tamaño de letra
            $pdf->SetXY(15, 20); //Margen en X y en Y
            $pdf->SetTextColor(15, 10, 222);
            $pdf->Write(0, 'casalimpia@administracion.com');
            $pdf->SetTextColor(0, 0, 0); //Color Negrita
            $pdf->SetXY(15, 25);
            $pdf->Write(0, $canal);
            
            
            
            $pdf->Ln(35); //Salto de Linea
            $pdf->Cell(40,26,'',0,0,'C');
            /*$pdf->SetDrawColor(50, 0, 0, 0);
            $pdf->SetFillColor(100, 0, 0, 0); */
            $pdf->SetTextColor(34,68,136);
            //$pdf->SetTextColor(255,204,0); //Amarillo
            //$pdf->SetTextColor(34,68,136); //Azul
            //$pdf->SetTextColor(153,204,0); //Verde
            //$pdf->SetTextColor(204,0,0); //Marron
            //$pdf->SetTextColor(245,245,205); //Gris claro
            //$pdf->SetTextColor(100, 0, 0); //Color Carne
            $pdf->SetFont('helvetica','B', 15); 
            $pdf->Cell(100,6,'LISTA DE ORDENES ABIERTAS',0,0,'C');
            
            
            $pdf->Ln(15); //Salto de Linea
            $pdf->SetTextColor(0, 0, 0); 
            
            //Almando la cabecera de la Tabla
            $pdf->SetFillColor(232,232,232);
            $pdf->SetFont('helvetica','B',9); //La B es para letras en Negritas
            $pdf->SetX(10);
            $pdf->Cell(30,6,'Producto',1,0,'C',1);
            $pdf->Cell(15,6,'Unidades',1,0,'C',1);
            $pdf->Cell(16,6,'Precio',1,0,'C',1);
            $pdf->Cell(12,6,'Iva',1,0,'C',1);
            $pdf->Cell(25,6,'Proveedor',1,0,'C',1);
            $pdf->Cell(25,6,'Direccion',1,0,'C',1);
            $pdf->Cell(25,6,'Total',1,0,'C',1);
            $pdf->Cell(18,6,'Estado',1,0,'C',1);
            $pdf->Cell(25,6,'Fecha de Orden',1,1,'C',1); 
            /*El 1 despues de  Fecha Ingreso indica que hasta alli 
            llega la linea */
            
            $pdf->SetFont('helvetica','',9);
            
            
            //SQL para consultas Empleados
            // $fechaInit = date("Y-m-d", strtotime($_POST['fecha_ingreso']));
            // $fechaFin  = date("Y-m-d", strtotime($_POST['fechaFin']));
            
            
            
            $sqlOrdenCompra = ("SELECT * FROM orden_compra WHERE estado ='Abierta'");
            //$sqlTrabajadores = ("SELECT * FROM trabajadores");
            $query = mysqli_query($con, $sqlOrdenCompra);
            
            while ($dataRow = mysqli_fetch_array($query)) {
                    $pdf->SetX(10);
                    $total = $dataRow['unidades'] * $dataRow['precio_producto'];
                    $totalCompleto = $total + 0.16;
                    $pdf->Cell(30,6,$dataRow['nombre_producto'],1,0,'C');
                    $pdf->Cell(15,6,$dataRow['unidades'],1,0,'C');
                    $pdf->Cell(16,6,$dataRow['precio_producto'].'$',1,0,'C');
                    $pdf->Cell(12,6,'0,16',1,0,'C');
                    $pdf->Cell(25,6,$dataRow['nombre_proveedor'],1,0,'C');
                    $pdf->Cell(25,6,$dataRow['direccion_proveedor'],1,0,'C');
                    $pdf->Cell(25,6,$totalCompleto.'$',1,0,'C');
                    $pdf->Cell(18,6,$dataRow['estado'],1,0,'C');
                    $pdf->Cell(25,6,(date('m-d-Y', strtotime($dataRow['fecha_orden']))),1,1,'C');
                }
            
            
            //$pdf->AddPage(); //Agregar nueva Pagina
            
            $pdf->Output('Resumen_Pedido_'.date('d_m_y').'.pdf', 'I'); 
            // Output funcion que recibe 2 parameros, el nombre del archivo, ver archivo o descargar,
            // La D es para Forzar una descarga
    } 
    
    else if($resultado =="Cerrada"){

        ob_end_clean(); //limpiar la memoria
    
        class MYPDF extends TCPDF{
              
                public function Header() {
                    $bMargin = $this->getBreakMargin();
                    $auto_page_break = $this->AutoPageBreak;
                    $this->SetAutoPageBreak(false, 0);
                    $img_file = dirname( __FILE__ ) .'/assets/img/limpiajpg.jpg';
                    $this->Image($img_file, 80, -3, 60, 60, 'JPG', '', '', false, 30, '', false, false, 0);
                    $this->SetAutoPageBreak($auto_page_break, $bMargin);
                    $this->setPageMark();
                }
        }

            //Iniciando un nuevo pdf
            $pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'mm', 'Letter', true, 'UTF-8', false);
     
            //Establecer margenes del PDF
            $pdf->SetMargins(20, 35, 25);
            $pdf->SetHeaderMargin(20);
            $pdf->setPrintFooter(false);
            $pdf->setPrintHeader(true); //Eliminar la linea superior del PDF por defecto
            $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM); //Activa o desactiva el modo de salto de página automático
     
            //Informacion del PDF
            $pdf->SetCreator('Casa Limpia');
            $pdf->SetAuthor('Casa Limpia');
            $pdf->SetTitle('Informe de Ordenes de Compra');

            $codigo = rand(999999, 111111);
    
            //Agregando la primera página
            $pdf->AddPage();
            $pdf->SetFont('helvetica','B',10); //Tipo de fuente y tamaño de letra
            $pdf->SetXY(150, 20);
            $pdf->Write(0, 'Código: '.'#'. $codigo);
            $pdf->SetXY(150, 25);
            $pdf->Write(0, 'Fecha: '. date('d-m-Y'));
            $pdf->SetXY(150, 30);
            $pdf->Write(0, 'Hora: '. date('h:i A'));
            
            $canal ='Casa Limpia Compañia Anónima';
            $pdf->SetFont('helvetica','B',10); //Tipo de fuente y tamaño de letra
            $pdf->SetXY(15, 20); //Margen en X y en Y
            $pdf->SetTextColor(15, 10, 222);
            $pdf->Write(0, 'casalimpia@administracion.com');
            $pdf->SetTextColor(0, 0, 0); //Color Negrita
            $pdf->SetXY(15, 25);
            $pdf->Write(0, $canal);
            
            
            
            $pdf->Ln(35); //Salto de Linea
            $pdf->Cell(40,26,'',0,0,'C');
            /*$pdf->SetDrawColor(50, 0, 0, 0);
            $pdf->SetFillColor(100, 0, 0, 0); */
            $pdf->SetTextColor(34,68,136);
            //$pdf->SetTextColor(255,204,0); //Amarillo
            //$pdf->SetTextColor(34,68,136); //Azul
            //$pdf->SetTextColor(153,204,0); //Verde
            //$pdf->SetTextColor(204,0,0); //Marron
            //$pdf->SetTextColor(245,245,205); //Gris claro
            //$pdf->SetTextColor(100, 0, 0); //Color Carne
            $pdf->SetFont('helvetica','B', 15); 
            $pdf->Cell(100,6,'LISTA DE ORDENES CERRADAS',0,0,'C');
            
            
            $pdf->Ln(15); //Salto de Linea
            $pdf->SetTextColor(0, 0, 0); 
            
            //Almando la cabecera de la Tabla
            $pdf->SetFillColor(232,232,232);
            $pdf->SetFont('helvetica','B',9); //La B es para letras en Negritas
            $pdf->SetX(10);
            $pdf->Cell(30,6,'Producto',1,0,'C',1);
            $pdf->Cell(15,6,'Unidades',1,0,'C',1);
            $pdf->Cell(16,6,'Precio',1,0,'C',1);
            $pdf->Cell(12,6,'Iva',1,0,'C',1);
            $pdf->Cell(25,6,'Proveedor',1,0,'C',1);
            $pdf->Cell(25,6,'Direccion',1,0,'C',1);
            $pdf->Cell(25,6,'Total',1,0,'C',1);
            $pdf->Cell(18,6,'Estado',1,0,'C',1);
            $pdf->Cell(25,6,'Fecha de Orden',1,1,'C',1); 
            /*El 1 despues de  Fecha Ingreso indica que hasta alli 
            llega la linea */
            
            $pdf->SetFont('helvetica','',9);
            
            
            //SQL para consultas Empleados
            // $fechaInit = date("Y-m-d", strtotime($_POST['fecha_ingreso']));
            // $fechaFin  = date("Y-m-d", strtotime($_POST['fechaFin']));
            
            
            
            $sqlOrdenCompra = ("SELECT * FROM orden_compra WHERE estado ='Cerrada'");
            //$sqlTrabajadores = ("SELECT * FROM trabajadores");
            $query = mysqli_query($con, $sqlOrdenCompra);
            
            while ($dataRow = mysqli_fetch_array($query)) {
                    $pdf->SetX(10);
                    $total = $dataRow['unidades'] * $dataRow['precio_producto'];
                    $totalCompleto = $total + 0.16;
                    $pdf->Cell(30,6,$dataRow['nombre_producto'],1,0,'C');
                    $pdf->Cell(15,6,$dataRow['unidades'],1,0,'C');
                    $pdf->Cell(16,6,$dataRow['precio_producto'].'$',1,0,'C');
                    $pdf->Cell(12,6,'0,16',1,0,'C');
                    $pdf->Cell(25,6,$dataRow['nombre_proveedor'],1,0,'C');
                    $pdf->Cell(25,6,$dataRow['direccion_proveedor'],1,0,'C');
                    $pdf->Cell(25,6,$totalCompleto.'$',1,0,'C');
                    $pdf->Cell(18,6,$dataRow['estado'],1,0,'C');
                    $pdf->Cell(25,6,(date('m-d-Y', strtotime($dataRow['fecha_orden']))),1,1,'C');
                }
            
            
            //$pdf->AddPage(); //Agregar nueva Pagina
            
            $pdf->Output('Resumen_Pedido_'.date('d_m_y').'.pdf', 'I'); 
            // Output funcion que recibe 2 parameros, el nombre del archivo, ver archivo o descargar,
            // La D es para Forzar una descarga


    }

    ob_end_clean(); //limpiar la memoria
    
    
    class MYPDF extends TCPDF{
          
            public function Header() {
                $bMargin = $this->getBreakMargin();
                $auto_page_break = $this->AutoPageBreak;
                $this->SetAutoPageBreak(false, 0);
                $img_file = dirname( __FILE__ ) .'/assets/img/limpiajpg.jpg';
                $this->Image($img_file, 80, -3, 60, 60, 'JPG', '', '', false, 30, '', false, false, 0);
                $this->SetAutoPageBreak($auto_page_break, $bMargin);
                $this->setPageMark();
            }
    }
    
    
    //Iniciando un nuevo pdf
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'mm', 'Letter', true, 'UTF-8', false);
     
    //Establecer margenes del PDF
    $pdf->SetMargins(20, 35, 25);
    $pdf->SetHeaderMargin(20);
    $pdf->setPrintFooter(false);
    $pdf->setPrintHeader(true); //Eliminar la linea superior del PDF por defecto
    $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM); //Activa o desactiva el modo de salto de página automático
     
    //Informacion del PDF
    $pdf->SetCreator('Casa Limpia');
    $pdf->SetAuthor('Casa Limpia');
    $pdf->SetTitle('Informe de Ordenes de Compra');
     
    /** Eje de Coordenadas
     *          Y
     *          -
     *          - 
     *          -
     *  X ------------- X
     *          -
     *          -
     *          -
     *          Y
     * 
     * $pdf->SetXY(X, Y);
     */
    
    $codigo = rand(999999, 111111);
    
    //Agregando la primera página
    $pdf->AddPage();
    $pdf->SetFont('helvetica','B',10); //Tipo de fuente y tamaño de letra
    $pdf->SetXY(150, 20);
    $pdf->Write(0, 'Código: '.'#'. $codigo);
    $pdf->SetXY(150, 25);
    $pdf->Write(0, 'Fecha: '. date('d-m-Y'));
    $pdf->SetXY(150, 30);
    $pdf->Write(0, 'Hora: '. date('h:i A'));
    
    $canal ='Casa Limpia Compañia Anónima';
    $pdf->SetFont('helvetica','B',10); //Tipo de fuente y tamaño de letra
    $pdf->SetXY(15, 20); //Margen en X y en Y
    $pdf->SetTextColor(15, 10, 222);
    $pdf->Write(0, 'casalimpia@administracion.com');
    $pdf->SetTextColor(0, 0, 0); //Color Negrita
    $pdf->SetXY(15, 25);
    $pdf->Write(0, $canal);
    
    
    
    $pdf->Ln(35); //Salto de Linea
    $pdf->Cell(40,26,'',0,0,'C');
    /*$pdf->SetDrawColor(50, 0, 0, 0);
    $pdf->SetFillColor(100, 0, 0, 0); */
    $pdf->SetTextColor(34,68,136);
    //$pdf->SetTextColor(255,204,0); //Amarillo
    //$pdf->SetTextColor(34,68,136); //Azul
    //$pdf->SetTextColor(153,204,0); //Verde
    //$pdf->SetTextColor(204,0,0); //Marron
    //$pdf->SetTextColor(245,245,205); //Gris claro
    //$pdf->SetTextColor(100, 0, 0); //Color Carne
    $pdf->SetFont('helvetica','B', 15); 
    $pdf->Cell(100,6,'LISTA DE ORDENES',0,0,'C');
    
    
    $pdf->Ln(15); //Salto de Linea
    $pdf->SetTextColor(0, 0, 0); 
    
    //Almando la cabecera de la Tabla
    $pdf->SetFillColor(232,232,232);
    $pdf->SetFont('helvetica','B',9); //La B es para letras en Negritas
    $pdf->SetX(10);
    $pdf->Cell(30,6,'Producto',1,0,'C',1);
    $pdf->Cell(15,6,'Unidades',1,0,'C',1);
    $pdf->Cell(16,6,'Precio',1,0,'C',1);
    $pdf->Cell(12,6,'Iva',1,0,'C',1);
    $pdf->Cell(25,6,'Proveedor',1,0,'C',1);
    $pdf->Cell(25,6,'Direccion',1,0,'C',1);
    $pdf->Cell(25,6,'Total',1,0,'C',1);
    $pdf->Cell(18,6,'Estado',1,0,'C',1);
    $pdf->Cell(25,6,'Fecha de Orden',1,1,'C',1); 
    /*El 1 despues de  Fecha Ingreso indica que hasta alli 
    llega la linea */
    
    $pdf->SetFont('helvetica','',9);
    
    
    //SQL para consultas Empleados
    // $fechaInit = date("Y-m-d", strtotime($_POST['fecha_ingreso']));
    // $fechaFin  = date("Y-m-d", strtotime($_POST['fechaFin']));
    
    
    
    $sqlOrdenCompra = ("SELECT * FROM orden_compra");
    //$sqlTrabajadores = ("SELECT * FROM trabajadores");
    $query = mysqli_query($con, $sqlOrdenCompra);
    
    while ($dataRow = mysqli_fetch_array($query)) {
            $pdf->SetX(10);
            $total = $dataRow['unidades'] * $dataRow['precio_producto'];
            $totalCompleto = $total + 0.16;
            $pdf->Cell(30,6,$dataRow['nombre_producto'],1,0,'C');
            $pdf->Cell(15,6,$dataRow['unidades'],1,0,'C');
            $pdf->Cell(16,6,$dataRow['precio_producto'].'$',1,0,'C');
            $pdf->Cell(12,6,'0,16',1,0,'C');
            $pdf->Cell(25,6,$dataRow['nombre_proveedor'],1,0,'C');
            $pdf->Cell(25,6,$dataRow['direccion_proveedor'],1,0,'C');
            $pdf->Cell(25,6,$totalCompleto.'$',1,0,'C');
            $pdf->Cell(18,6,$dataRow['estado'],1,0,'C');
            $pdf->Cell(25,6,(date('m-d-Y', strtotime($dataRow['fecha_orden']))),1,1,'C');
        }
    
    
    //$pdf->AddPage(); //Agregar nueva Pagina
    
    $pdf->Output('Resumen_Pedido_'.date('d_m_y').'.pdf', 'I'); 
    // Output funcion que recibe 2 parameros, el nombre del archivo, ver archivo o descargar,
    // La D es para Forzar una descarga

}



