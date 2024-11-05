-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: localhost    Database: citasmedicas
-- ------------------------------------------------------
-- Server version	8.0.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citas` (
  `idCita` int NOT NULL AUTO_INCREMENT,
  `idUsuario` int NOT NULL,
  `fechaCita` date NOT NULL,
  `motivoCita` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`idCita`),
  UNIQUE KEY `motivoCita` (`motivoCita`(60)),
  KEY `citas_ibfk_1` (`idUsuario`),
  CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `users_data` (`idUser`) ON DELETE CASCADE,
  CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `users_data` (`idUser`) ON DELETE CASCADE,
  CONSTRAINT `nuevo_nombre_foreign_key` FOREIGN KEY (`idUsuario`) REFERENCES `users_data` (`idUser`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (83,14,'2024-10-17','diabetes'),(102,7,'2024-10-31','migraña'),(104,8,'2024-10-30','neumologia'),(108,8,'2024-10-31','tos muy seca y muy severa'),(117,45,'2024-11-16','gastritis cronica');
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticias`
--

DROP TABLE IF EXISTS `noticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `noticias` (
  `idNoticia` int NOT NULL AUTO_INCREMENT,
  `titulo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `texto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `idUsuario` int NOT NULL,
  PRIMARY KEY (`idNoticia`),
  UNIQUE KEY `titulo` (`titulo`(60)),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `users_data` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticias`
--

LOCK TABLES `noticias` WRITE;
/*!40000 ALTER TABLE `noticias` DISABLE KEYS */;
INSERT INTO `noticias` VALUES (1,'Inauguración nueva sala de urgencias','1730069387_01_urgencias.jpg','La sala de urgencias ha sido renovada y modernizada para ofrecer atención de primera calidad. La nueva infraestructura permite optimizar los tiempos de espera.\nLos pacientes contarán con equipo de última tecnología. El personal médico está capacitado para manejar emergencias complejas de forma eficiente.\nEste evento forma parte de un esfuerzo integral del hospital.','2024-10-27',16),(3,'Maratón anual para recaudar fondos','1730070345_03_maraton.jpg','El hospital organizará un maratón con el fin de recaudar fondos para la compra de nuevos equipos médicos. El evento está abierto al público.\r\nSe espera la participación de familias, amigos y miembros de la comunidad. Además, habrá puntos de hidratación y primeros auxilios en la ruta.\r\nTodo lo recaudado contribuirá a mejorar las instalaciones y la atención de pacientes.','2024-10-27',16),(4,'Jornada de vacunación en el barrio','1730070395_04_vacunacion.jpg','El hospital ha organizado una jornada de vacunación gratuita en colaboración con la municipalidad local. La actividad se realizará este fin de semana en horas de la mañana.\nLa vacunación incluye dosis para prevenir enfermedades como la gripe y el tétano. Los habitantes podrán asistir sin necesidad de cita previa.\nEsta jornada busca fortalecer la salud y el bienestar a las personas de la comunidad de madrid.','2024-10-27',16),(5,'Taller de primeros auxilios gratuito','1730070477_05_primero_auxilios.jpg','Un taller de primeros auxilios será impartido en el centro comunitario de leganés, patrocinado por el hospital. Será gratuito y abierto a todo público.\nEste taller enseñará técnicas básicas para atender emergencias comunes en el hogar. Los asistentes recibirán un certificado de participación.\nEs parte del compromiso del hospital de capacitar a la comunidad en salud, bienestar y mucha seguridad.','2024-10-27',16),(6,'Encuentro deportivo para la salud','1730070520_06_encuentro_deportivo.jpg','Se llevará a cabo un torneo en Madrid y sus alrededores deportivo en colaboración con el hospital y clubes locales. Se realizarán actividades de fútbol y voleibol.\nEl evento está enfocado en promover el ejercicio físico y la vida saludable. Se espera la asistencia de personas de todas las edades.\nHabrá puestos de hidratación y personal médico para apoyo en caso de necesidad.','2024-10-27',16),(7,'Nueva técnica para cirugía cardíaca','1730070562_07_cirugia.jpg','Se ha implementado una innovadora técnica en cirugía cardíaca que reduce el tiempo de recuperación. Esta técnica utiliza equipos especializados.\nEl procedimiento es menos invasivo y promete mejores resultados. El equipo de cardiología ha sido entrenado específicamente para aplicarlo.\nCon esta innovación, se espera mejorar la calidad de vida de los pacientes cardíacos.','2024-10-28',16),(11,'Importancia de la hidratación diaria','1730070765_11_hidratacion.jpg','Mantenerse bien hidratado es crucial para el funcionamiento óptimo del cuerpo. Los adultos deben consumir alrededor de dos litros de agua al día.\r\nLa deshidratación afecta funciones como la concentración y la digestión. Se aconseja tomar agua a lo largo del día, no solo al sentir sed.\r\nEstos hábitos pueden prevenir problemas de salud relacionados con la falta de líquidos.','2024-10-29',16),(12,'Alimentos para fortalecer defensas','1730070803_12_alimentacion.jpg','El sistema inmunológico se beneficia de una dieta balanceada rica en vitaminas. Incluye frutas, verduras y proteínas para mantener defensas fuertes.\nEl consumo regular de vitamina C y zinc refuerza el sistema. Los cítricos, pimientos y frutos secos son excelentes fuentes naturales.\nMantener una dieta variada reduce el riesgo de infecciones y ayuda a sentirse mejor en general.','2024-10-29',16),(14,'Las enfermedades respiratorias','1730071488_02_charla.jpg','El hospital ofrecerá una charla gratuita sobre la prevención de enfermedades respiratorias comunes. Esta actividad está dirigida a pacientes y sus familias.\nMédicos especializados brindarán recomendaciones y resolverán dudas. El objetivo es educar y prevenir complicaciones mediante prácticas saludables.\nLa charla es una de varias actividades educativas planificadas para la comunidad en este año.','2024-10-27',16),(15,'Avance en terapias contra cáncer','1730071581_09_terapia.jpg','El hospital ha anunciado una nueva terapia para combatir el cáncer, que ofrece mayores posibilidades de recuperación. Es un tratamiento de última generación.\r\nEsta opción está diseñada para pacientes en diferentes etapas de la enfermedad. La terapia ha sido aprobada y certificada por expertos.\r\nLos pacientes y sus familiares recibirán información detallada y asesoría en el hospital.','2024-10-29',16),(16,'Consejos para un sueño reparador','1730071669_10_sueno.jpg','Dormir bien es fundamental para la salud. Se recomienda mantener una rutina de sueño estable y evitar el uso de dispositivos electrónicos antes de dormir.\nPracticar la relajación antes de acostarse también ayuda a descansar mejor. El estrés afecta la calidad del sueño, así que intenta relajarte y estar muy tranquilo.\nSeguir estos consejos ayuda a reducir el insomnio y mejora la energía durante el día. ','2024-10-28',16),(17,'Informacion sobre la diabetes','1730071927_08_diabetes.jpg','Se han introducido nuevos tratamientos y programas de control de la diabetes en el hospital. Estas opciones buscan mejorar la adherencia del paciente.\r\nLos tratamientos incluyen un enfoque integral, con seguimiento y educación personalizada. La meta es reducir complicaciones asociadas a la diabetes.\r\nLos pacientes pueden consultar con su médico para conocer más sobre estos avances y opciones disponibles.','2024-10-29',16),(18,'nueva noticia de prueba','1730573508_10_sueno.jpg','esta esta una noticia de prueba','2024-11-01',16),(19,'una noticias mas de prueba','1730573626_09_terapia.jpg','esta es una noticia mas de prueba','2024-11-14',16),(20,'otra noticia mas de prueba','1730573766_06_encuentro_deportivo.jpg','etsaaaaaa','2024-11-04',16),(21,'titulo de prueba','1730573853_04_vacunacion.jpg','jjuuuu','2024-11-01',16),(24,'pruebaa','1730585265_07_cirugia.jpg','pruebakkkkkkkkkkkkkkkkkk','2024-11-15',16),(25,'hh','1730595947_09_terapia.jpg','hh','2024-11-06',16),(26,'nuuuuu','1730598153_08_diabetes.jpg','yeesss','2024-11-05',8),(27,'NOTICE','1730741353_12_alimentacion.jpg','PROBANDO','2024-11-04',8),(28,'FUNCIONANDO NOTICIA FECHA','1730741422_03_maraton.jpg','NOOOO O SI','2024-11-04',8),(29,'hfhfhfhfhhfh','1730741926_10_sueno.jpg','hhfhfhfhffhfhfh','2024-11-04',8);
/*!40000 ALTER TABLE `noticias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_data`
--

DROP TABLE IF EXISTS `users_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_data` (
  `idUser` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellidos` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `direccion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `sexo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_data`
--

LOCK TABLES `users_data` WRITE;
/*!40000 ALTER TABLE `users_data` DISABLE KEYS */;
INSERT INTO `users_data` VALUES (5,'maria juliana','gomez ortiz','juli@gmail.com','602416030','2013-09-08','avenida de la universidad 2 bloque 11 bajo izquierdo','mujer'),(7,'jessi paola','palacio','caro5050dani@hotmail.com','602416030','2023-05-17','extremadura 1999','mujer'),(8,'juli','gomez henao','juligomez@gmail.com','602416030','2024-09-05','extremadura 18','hombre'),(11,'javier orlando','henao tellez','glsfjlfjls@gmail.com','623738857','2024-09-07','calle hermanos quintero 1','hombre'),(14,'julianjulian','gomez henao','julianmjvdsvsvsadi@gmail.com','602416030','2024-09-10','extremadura 18','MUJER'),(16,'Julian','gomez henao','juhglianmjadi@gmail.com','602416030','2024-09-15','avenida de la universidad 2 bloque 11 bajo izquierdo','hombre'),(36,'javi ','gomez bedoya','julito@gmail.com','623738857','2024-06-13','armenia','hombre'),(45,'armando','armando mesa','armario@gmail.com','602416030','2024-08-07','extremadura 18','hombre');
/*!40000 ALTER TABLE `users_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_login`
--

DROP TABLE IF EXISTS `users_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_login` (
  `idLogin` int NOT NULL AUTO_INCREMENT,
  `idUsuario` int NOT NULL,
  `usuario` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `contrasena` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `rol` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`idLogin`),
  UNIQUE KEY `idUsuario` (`idUsuario`),
  UNIQUE KEY `usuario` (`usuario`(30)),
  CONSTRAINT `users_login_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `users_data` (`idUser`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_login`
--

LOCK TABLES `users_login` WRITE;
/*!40000 ALTER TABLE `users_login` DISABLE KEYS */;
INSERT INTO `users_login` VALUES (4,5,'julijuli08','$2y$10$S/fCrivNuE5uFEW7Ji9FQ.0x9cAwEaJ1NN4EyUmjRsh/tUcv6uSC2','admin'),(6,7,'jessipalacio','$2y$10$D3zeW7iHkfi1l8iRMPXzE.CC.RSjC8Gh84ruqEBElY9f9vxZpWegq','admin'),(7,8,'julianmj08','','admin'),(10,11,'javiorlando','$2y$10$Vtoa97CLBxpvJHfuyw97AON1y5kfnqi.CRpkDo5HL9QEbKy3Ak7ue','user'),(14,16,'juliandres','$2y$10$hvXmJHDhgqatm/2y.Nm2GeW..U5v0CB3Wra0ctoRNItJ5.irGX1YG','user'),(19,36,'javierT','$2y$10$1Nq4hWjnnteKfdeV3Dm/a.EVN7b6GIV3h.EZQXLhAVo02uAn9ZHjy','user'),(28,45,'armandom','$2y$10$kegZWmOYGPKVmOLBwbUVw.tSKNdtVU3W/KzYMAQvGW1QG17Qs5Yii','user');
/*!40000 ALTER TABLE `users_login` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-05  0:19:29
