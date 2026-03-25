# Diccionario de Datos

Documento generado en base a las migraciones de `database/migrations`.

## users
| Campo | Tipo | Restricciones | Descripcion |
|---|---|---|---|
| id | bigint (id) | PK | Identificador unico del usuario. |
| name | string | requerido | Nombres del usuario. |
| email | string | unico, requerido | Correo electronico de acceso. |
| email_verified_at | timestamp | nullable | Fecha/hora de verificacion del correo. |
| password | string | requerido | Hash de contrasena del usuario. |
| two_factor_secret | text | nullable | Secreto para autenticacion de dos factores. |
| two_factor_recovery_codes | text | nullable | Codigos de recuperacion para 2FA. |
| two_factor_confirmed_at | timestamp | nullable | Fecha/hora de confirmacion del 2FA. |
| remember_token | string | nullable | Token para recordar sesion. |
| created_at | timestamp | nullable | Fecha/hora de creacion del registro. |
| updated_at | timestamp | nullable | Fecha/hora de ultima actualizacion. |

## password_reset_tokens
| Campo | Tipo | Restricciones | Descripcion |
|---|---|---|---|
| email | string | PK | Correo asociado a la recuperacion. |
| token | string | requerido | Token de restablecimiento de contrasena. |
| created_at | timestamp | nullable | Fecha/hora de generacion del token. |

## sessions
| Campo | Tipo | Restricciones | Descripcion |
|---|---|---|---|
| id | string | PK | Identificador de sesion. |
| user_id | foreignId | nullable, index | Usuario propietario de la sesion. |
| ip_address | string(45) | nullable | Direccion IP del cliente. |
| user_agent | text | nullable | Navegador/dispositivo del cliente. |
| payload | longText | requerido | Datos serializados de la sesion. |
| last_activity | integer | index | Ultima actividad (timestamp Unix). |

## cache
| Campo | Tipo | Restricciones | Descripcion |
|---|---|---|---|
| key | string | PK | Clave de cache. |
| value | mediumText | requerido | Valor almacenado en cache. |
| expiration | integer | index | Tiempo de expiracion (timestamp Unix). |

## cache_locks
| Campo | Tipo | Restricciones | Descripcion |
|---|---|---|---|
| key | string | PK | Clave del bloqueo de cache. |
| owner | string | requerido | Propietario del bloqueo. |
| expiration | integer | index | Tiempo de expiracion del bloqueo. |

## jobs
| Campo | Tipo | Restricciones | Descripcion |
|---|---|---|---|
| id | bigint (id) | PK | Identificador del job en cola. |
| queue | string | index | Nombre de la cola. |
| payload | longText | requerido | Carga util serializada del job. |
| attempts | unsignedTinyInteger | requerido | Numero de intentos ejecutados. |
| reserved_at | unsignedInteger | nullable | Fecha/hora de reserva del job. |
| available_at | unsignedInteger | requerido | Fecha/hora desde cuando esta disponible. |
| created_at | unsignedInteger | requerido | Fecha/hora de creacion del job. |

## job_batches
| Campo | Tipo | Restricciones | Descripcion |
|---|---|---|---|
| id | string | PK | Identificador del lote de jobs. |
| name | string | requerido | Nombre del lote. |
| total_jobs | integer | requerido | Cantidad total de jobs del lote. |
| pending_jobs | integer | requerido | Cantidad de jobs pendientes. |
| failed_jobs | integer | requerido | Cantidad de jobs fallidos. |
| failed_job_ids | longText | requerido | IDs de jobs fallidos en el lote. |
| options | mediumText | nullable | Opciones de configuracion del lote. |
| cancelled_at | integer | nullable | Fecha/hora de cancelacion. |
| created_at | integer | requerido | Fecha/hora de creacion del lote. |
| finished_at | integer | nullable | Fecha/hora de finalizacion del lote. |

## failed_jobs
| Campo | Tipo | Restricciones | Descripcion |
|---|---|---|---|
| id | bigint (id) | PK | Identificador del registro de fallo. |
| uuid | string | unico | UUID del job fallido. |
| connection | text | requerido | Conexion usada por la cola. |
| queue | text | requerido | Cola donde fallo el job. |
| payload | longText | requerido | Carga util del job fallido. |
| exception | longText | requerido | Excepcion/stack trace del fallo. |
| failed_at | timestamp | useCurrent | Fecha/hora del fallo. |

## empleados
| Campo | Tipo | Restricciones | Descripcion |
|---|---|---|---|
| id | bigint (id) | PK | Identificador unico del empleado. |
| codigo | string(30) | unico, requerido | Codigo interno del empleado (sincronizado con DNI). |
| numero_documento | string(30) | unico, requerido | Numero de documento de identidad. |
| nombres | string(255) | requerido | Nombres del empleado. |
| apellidos | string(255) | requerido | Apellidos del empleado. |
| cargo | string | nullable | Cargo o puesto laboral. |
| condicion_laboral | string | nullable | Condicion laboral del empleado. |
| estado | boolean | default true | Estado activo/inactivo del empleado. |
| created_at | timestamp | nullable | Fecha/hora de creacion del registro. |
| updated_at | timestamp | nullable | Fecha/hora de ultima actualizacion. |

## feriados
| Campo | Tipo | Restricciones | Descripcion |
|---|---|---|---|
| id | bigint (id) | PK | Identificador unico del feriado. |
| nombre | string | requerido | Nombre o descripcion del feriado. |
| fecha | date | unico, requerido | Fecha del feriado. |
| es_recuperable | boolean | default false | Indica si el dia es recuperable. |
| estado | boolean | default true | Estado activo/inactivo del feriado. |
| created_at | timestamp | nullable | Fecha/hora de creacion del registro. |
| updated_at | timestamp | nullable | Fecha/hora de ultima actualizacion. |

## horarios
| Campo | Tipo | Restricciones | Descripcion |
|---|---|---|---|
| id | bigint (id) | PK | Identificador unico del horario. |
| nombre | string | requerido | Nombre del horario. |
| hora_entrada | time | requerido | Hora de ingreso. |
| hora_salida | time | requerido | Hora de salida. |
| tolerancia_minutos | unsignedSmallInteger | default 0 | Minutos de tolerancia para tardanzas. |
| estado | boolean | default true | Estado activo/inactivo del horario. |
| created_at | timestamp | nullable | Fecha/hora de creacion del registro. |
| updated_at | timestamp | nullable | Fecha/hora de ultima actualizacion. |

## turnos
| Campo | Tipo | Restricciones | Descripcion |
|---|---|---|---|
| id | bigint (id) | PK | Identificador unico del turno. |
| nombre | string | requerido | Nombre del turno. |
| hora_inicio | time | requerido | Hora de inicio del turno. |
| hora_fin | time | requerido | Hora de fin del turno. |
| estado | boolean | default true | Estado activo/inactivo del turno. |
| created_at | timestamp | nullable | Fecha/hora de creacion del registro. |
| updated_at | timestamp | nullable | Fecha/hora de ultima actualizacion. |

## periodos
| Campo | Tipo | Restricciones | Descripcion |
|---|---|---|---|
| id | bigint (id) | PK | Identificador unico del periodo. |
| nombre | string | requerido | Nombre del periodo. |
| fecha_inicio | date | requerido | Fecha de inicio del periodo. |
| fecha_fin | date | requerido | Fecha de fin del periodo. |
| cerrado | boolean | default false | Indica si el periodo esta cerrado. |
| estado | boolean | default true | Estado activo/inactivo del periodo. |
| created_at | timestamp | nullable | Fecha/hora de creacion del registro. |
| updated_at | timestamp | nullable | Fecha/hora de ultima actualizacion. |

## tipo_boletas
| Campo | Tipo | Restricciones | Descripcion |
|---|---|---|---|
| id | bigint (id) | PK | Identificador unico del tipo de boleta. |
| nombre | string | requerido | Nombre del tipo de boleta. |
| descripcion | text | nullable | Descripcion funcional del tipo de boleta. |
| estado | boolean | default true | Estado activo/inactivo del tipo de boleta. |
| created_at | timestamp | nullable | Fecha/hora de creacion del registro. |
| updated_at | timestamp | nullable | Fecha/hora de ultima actualizacion. |