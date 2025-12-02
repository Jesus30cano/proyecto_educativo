<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen-estudiante</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600;700&family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Crimson Text', 'Georgia', serif;
            background: linear-gradient(135deg, #e8f4f8 0%, #f0e8f4 100%);
            min-height: 100vh;
            padding: 50px 20px;
            color: #1a1a1a;
        }
        
        .exam-container {
            max-width: 1100px;
            margin: 0 auto;
            background: #ffffff;
            border: 3px double #2c5f7f;
            box-shadow: 0 8px 24px rgba(44,95,127,0.2);
            position: relative;
        }
        
        .exam-container::before {
            content: '';
            position: absolute;
            top: 8px;
            left: 8px;
            right: 8px;
            bottom: 8px;
            border: 1px solid #c8dce8;
            pointer-events: none;
        }
        
        .exam-header {
            background: linear-gradient(135deg, #2c5f7f 0%, #3a7ba8 100%);
            color: #ffffff;
            padding: 35px 45px;
            text-align: center;
            position: relative;
            border-bottom: 3px solid #245168;
        }
        
        .header-decoration {
            width: 100px;
            height: 3px;
            background: #ffffff;
            margin: 0 auto 15px;
        }
        
        .exam-header h1 {
            font-family: 'Libre Baskerville', serif;
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 6px;
        }
        
        .header-line {
            width: 100px;
            height: 3px;
            background: #ffffff;
            margin: 15px auto 0;
        }
        
        .exam-content {
            padding: 50px 55px;
            position: relative;
        }
        
        .title-section {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 3px double #2c5f7f;
        }
        
        .exam-title {
            font-family: 'Libre Baskerville', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c5f7f;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 3px;
        }
        
        .exam-info {
            background: #f8fbfd;
            padding: 0;
            border: 2px solid #2c5f7f;
            margin-bottom: 40px;
        }
        
        .info-header {
            background: linear-gradient(135deg, #3a7ba8 0%, #2c5f7f 100%);
            padding: 12px 20px;
            border-bottom: 2px solid #245168;
        }
        
        .info-header-text {
            font-family: 'Libre Baskerville', serif;
            font-size: 0.9rem;
            font-weight: 700;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .info-row {
            border-bottom: 1px solid #d0d0d0;
        }
        
        .info-row:last-child {
            border-bottom: none;
        }
        
        .info-cell {
            padding: 20px 25px;
            vertical-align: top;
            width: 50%;
            border-right: 1px solid #d0d0d0;
        }
        
        .info-cell:last-child {
            border-right: none;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .info-label {
            font-family: 'Libre Baskerville', serif;
            font-weight: 700;
            color: #3a7ba8;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        
        .info-value {
            color: #2a2a2a;
            font-size: 1.05rem;
            font-weight: 400;
            line-height: 1.6;
        }
        
        .description-full {
            padding: 25px;
            border-top: 2px solid #2c5f7f;
            background: #ffffff;
        }
        
        .section-divider {
            width: 80px;
            height: 2px;
            background: linear-gradient(90deg, transparent, #3a7ba8, transparent);
            margin: 40px auto;
        }
        
        .questions-section {
            margin-top: 45px;
        }
        
        .questions-header {
            text-align: center;
            margin-bottom: 35px;
            position: relative;
        }
        
        .questions-title {
            font-family: 'Libre Baskerville', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
            padding: 14px 30px;
            background: linear-gradient(135deg, #2c5f7f 0%, #3a7ba8 100%);
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 3px;
            border: 2px solid #245168;
        }
        
        .questions-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }
        
        .question-card {
            background: #f8fbfd;
            border: 2px solid #3a7ba8;
            padding: 25px;
            position: relative;
            page-break-inside: avoid;
        }
        
        .question-card::before {
            content: '';
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            border: 1px solid #c8dce8;
            pointer-events: none;
        }
        
        .question-number {
            font-family: 'Libre Baskerville', serif;
            display: inline-block;
            font-weight: 700;
            color: #ffffff;
            background: linear-gradient(135deg, #3a7ba8 0%, #2c5f7f 100%);
            padding: 8px 18px;
            margin-bottom: 18px;
            font-size: 0.95rem;
            letter-spacing: 2px;
            border: 2px solid #245168;
        }
        
        .question-text {
            font-size: 1.08rem;
            color: #1a1a1a;
            margin-bottom: 20px;
            line-height: 1.7;
            font-weight: 400;
            padding-bottom: 12px;
            border-bottom: 1px solid #c8dce8;
        }
        
        .option {
            padding: 12px 14px;
            margin-bottom: 8px;
            border: 1px solid #c8dce8;
            display: flex;
            align-items: flex-start;
            cursor: pointer;
            background: #ffffff;
            transition: all 0.2s ease;
        }
        
        .option:hover {
            background: #f0f7fc;
            border-color: #3a7ba8;
        }
        
        .option input[type="radio"] {
            margin-right: 12px;
            margin-top: 4px;
            cursor: pointer;
            width: 17px;
            height: 17px;
            accent-color: #3a7ba8;
            flex-shrink: 0;
        }
        
        .option label {
            cursor: pointer;
            margin: 0;
            font-size: 1rem;
            color: #2a2a2a;
            flex: 1;
            font-weight: 400;
            line-height: 1.6;
        }
        
        .option.selected {
            border-color: #43b74c !important;
            background: #e6f7e9 !important;
        }
        
        .option.selected label {
            color: #237439 !important;
            font-weight: 600;
        }
        
        .option.selected input[type="radio"]:checked {
            accent-color: #43b74c;
        }
        
        .option.selected-correct {
            border-color: #42c17c !important;
            background: #e8faef !important;
        }
        
        .option.selected-correct label {
            color: #20683c !important;
            font-weight: 600;
        }
        
        .option.selected-correct input[type="radio"]:checked {
            accent-color: #2ba058;
        }
        
        .option.selected-wrong {
            border-color: #e44d4d !important;
            background: #ffeaea !important;
        }
        
        .option.selected-wrong label {
            color: #a61818 !important;
            font-weight: 600;
        }
        
        .option.selected-wrong input[type="radio"]:checked {
            accent-color: #e44d4d;
        }
        
        .option.only-correct {
            border-color: #42a5f5 !important;
            background: #eaf4ff !important;
        }
        
        .option.only-correct label {
            color: #215982 !important;
            font-weight: 600;
        }
        
        .exam-footer {
            margin-top: 50px;
            text-align: center;
            padding-top: 30px;
        }
        
        .footer-line {
            width: 120px;
            height: 2px;
            background: linear-gradient(90deg, transparent, #3a7ba8, transparent);
            margin: 0 auto 15px;
        }
        
        .footer-text {
            font-family: 'Libre Baskerville', serif;
            font-size: 0.85rem;
            color: #4a4a4a;
            font-style: italic;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .exam-container {
                box-shadow: none;
                border: 2px solid #2c5f7f;
                max-width: 100%;
            }
            
            .question-card {
                page-break-inside: avoid;
            }
            
            .exam-footer {
                page-break-before: avoid;
            }
            
            .questions-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
        }
        
        @media (max-width: 768px) {
            body {
                padding: 20px 10px;
            }
            
            .exam-header {
                padding: 25px 20px;
            }
            
            .exam-header h1 {
                font-size: 1.5rem;
                letter-spacing: 3px;
            }
            
            .exam-content {
                padding: 30px 25px;
            }
            
            .info-table {
                display: block;
            }
            
            .info-row {
                display: block;
            }
            
            .info-cell {
                display: block;
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #d0d0d0;
                padding: 15px 20px;
            }
            
            .info-cell:last-child {
                border-bottom: none;
            }
            
            .questions-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .exam-title {
                font-size: 1.2rem;
                letter-spacing: 2px;
            }
            
            .question-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="exam-container">
        <!-- Encabezado institucional -->
        <div class="exam-header">
            <div class="header-decoration"></div>
            <h1>EVALUACIÓN ACADÉMICA</h1>
            <div class="header-line"></div>
        </div>
        
        <div class="exam-content">
            <!-- Título del examen -->
            <div class="title-section">
                <h2 class="exam-title" id="exam-title">Título de la Evaluación</h2>
            </div>
            
            <!-- Información del examen -->
            <div class="exam-info">
                <div class="info-header">
                    <span class="info-header-text">INFORMACIÓN DEL EXAMEN</span>
                </div>
                
                <table class="info-table">
                    <tbody>
                        <tr class="info-row">
                            <td class="info-cell">
                                <div class="info-item">
                                    <span class="info-label">Docente:</span>
                                    <span class="info-value" id="teacher-name">Nombre del Docente</span>
                                </div>
                            </td>
                            <td class="info-cell">
                                <div class="info-item">
                                    <span class="info-label">Fecha:</span>
                                    <span class="info-value" id="exam-date">00/00/0000</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="info-row">
                            <td class="info-cell">
                                <div class="info-item">
                                    <span class="info-label">Estudiante:</span>
                                    <span class="info-value" id="student-name">Nombre del Estudiante</span>
                                </div>
                            </td>
                            <td class="info-cell">
                                <div class="info-item">
                                    <span class="info-label">Calificación:</span>
                                    <span class="info-value" id="exam-grade">calificacion</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="info-row">
                            <td class="info-cell">
                                <div class="info-item">
                                    <span class="info-label">Curso:</span>
                                    <span class="info-value" id="course-name">Nombre del Curso</span>
                                </div>
                            </td>
                            <td class="info-cell">
                                <div class="info-item">
                                    <span class="info-label">Competencia:</span>
                                    <span class="info-value" id="competence-name">Nombre de la Competencia</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="description-full">
                    <div class="info-item">
                        <span class="info-label">Descripción:</span>
                        <div class="info-value" id="exam-description">Descripción de la evaluación</div>
                    </div>
                </div>
            </div>
            
            <!-- Línea separadora -->
            <div class="section-divider"></div>
            
            <!-- Sección de preguntas -->
            <div class="questions-section">
                <div class="questions-header">
                    <h3 class="questions-title">PREGUNTAS DE EVALUACIÓN</h3>
                </div>
                <div class="questions-grid" id="questions-container">
                    <!-- Las preguntas se insertarán aquí desde JavaScript -->
                </div>
            </div>
            
            <!-- Pie de página -->
            <div class="exam-footer">
                <div class="footer-line"></div>
                <p class="footer-text">Resultados de la evaluación</p>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/public/js/teacher/ver_examen_estudiante.js"></script>
</body>
</html>