<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #E3F2FD;
            min-height: 100vh;
            padding: 40px 20px;
        }
        
        .exam-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        
        .exam-header {
            background: #1565C0 ;
            color: white;
            padding: 40px;
            text-align: left; 
            position: relative;
        }
        
        .exam-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
        }
        
        .exam-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 3px;
            position: relative;
            z-index: 1;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .exam-content {
            padding: 40px;
        }
        
        .exam-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #1a252f;
            margin-bottom: 30px;
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 3px solid #1e88e5;
        }
        
        .exam-info {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 40px;
            border-left: 4px solid #1e88e5;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .info-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 20px;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .info-label {
            font-weight: 600;
            color: #1565c0;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .info-value {
            color: #2d3748;
            font-size: 1.05rem;
            font-weight: 500;
            padding: 8px 12px;
            background: white;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }
        
        .description-full {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #e2e8f0;
        }
        
        .questions-section {
            margin-top: 40px;
        }
        
        .questions-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: white;
            margin-bottom: 30px;
            padding: 15px 20px;
            background: #1565c0;
            border-radius: 6px;
            box-shadow: 0 2px 10px rgba(30,136,229,0.25);
        }
        
        .questions-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }
        
        .question-card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 25px;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .question-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 3px;
            height: 100%;
            background: #1e88e5;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        
        .question-card:hover {
            box-shadow: 0 4px 16px rgba(30,136,229,0.15);
            border-color: #1e88e5;
        }
        
        .question-card:hover::before {
            transform: scaleY(1);
        }
        
        .question-number {
            display: inline-block;
            font-weight: 600;
            color: white;
            background: #1565c0;
            padding: 6px 14px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }
        
        .question-text {
            font-size: 1.05rem;
            color: #2d3748;
            margin-bottom: 20px;
            line-height: 1.6;
            font-weight: 500;
        }
        
        .option {
            padding: 12px 15px;
            margin-bottom: 10px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
            cursor: pointer;
            background: #fafafa;
        }
        
        .option:hover {
            background: #f0f4f8;
            border-color: #1e88e5;
        }
        
        .option input[type="radio"] {
            margin-right: 12px;
            cursor: pointer;
            width: 18px;
            height: 18px;
            accent-color: #1e88e5;
        }
        
        .option label {
            cursor: pointer;
            margin: 0;
            font-size: 0.95rem;
            color: #4a5568;
            flex: 1;
            font-weight: 400;
        }
        
        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .exam-container {
                box-shadow: none;
            }
            
            .question-card {
                page-break-inside: avoid;
            }
        }
        
        @media (max-width: 768px) {
            .exam-header h1 {
                font-size: 1.8rem;
            }
            
            .exam-content {
                padding: 20px;
            }
            
            .info-row {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .questions-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .exam-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="exam-container">
        <!-- Encabezado -->
        <div class="exam-header">
            <h1>EXAMEN</h1>
        </div>
        
        <div class="exam-content">
            <!-- Título del examen -->
            <h2 class="exam-title" id="exam-title">Título de la Evaluación</h2>
            
            <!-- Información del examen -->
            <div class="exam-info">
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Docente</span>
                        <span class="info-value" id="teacher-name">Nombre del Docente</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Fecha</span>
                        <span class="info-value" id="exam-date">00/00/0000</span>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Curso</span>
                        <span class="info-value" id="course-name">Nombre del Curso</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Competencia</span>
                        <span class="info-value" id="competence-name">Nombre de la Competencia</span>
                    </div>
                </div>
                
                <div class="description-full">
                    <div class="info-item">
                        <span class="info-label">Descripción</span>
                        <span class="info-value" id="exam-description">Descripción de la evaluación</span>
                    </div>
                </div>
            </div>
            
            <!-- Sección de preguntas -->
            <div class="questions-section">
                <h3 class="questions-title">Preguntas</h3>
                <div class="questions-grid" id="questions-container">
                    <!-- Las preguntas se insertarán aquí desde JavaScript -->
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/public/js/teacher/ver_examen.js"></script>
</body>
</html>