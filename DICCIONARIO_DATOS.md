# Diccionario de Datos

Documento generado en base a las migraciones de `database/migrations`.

## users
| Campo | Tipo | Restricciones |
|---|---|---|
| id | bigint (id) | PK |
| name | string | requerido |
| email | string | unico, requerido |
| email_verified_at | timestamp | nullable |
| password | string | requerido |
| two_factor_secret | text | nullable |
| two_factor_recovery_codes | text | nullable |
| two_factor_confirmed_at | timestamp | nullable |
| remember_token | string | nullable |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

## password_reset_tokens
| Campo | Tipo | Restricciones |
|---|---|---|
| email | string | PK |
| token | string | requerido |
| created_at | timestamp | nullable |

## sessions
| Campo | Tipo | Restricciones |
|---|---|---|
| id | string | PK |
| user_id | foreignId | nullable, index |
| ip_address | string(45) | nullable |
| user_agent | text | nullable |
| payload | longText | requerido |
| last_activity | integer | index |

## cache
| Campo | Tipo | Restricciones |
|---|---|---|
| key | string | PK |
| value | mediumText | requerido |
| expiration | integer | index |

## cache_locks
| Campo | Tipo | Restricciones |
|---|---|---|
| key | string | PK |
| owner | string | requerido |
| expiration | integer | index |

## jobs
| Campo | Tipo | Restricciones |
|---|---|---|
| id | bigint (id) | PK |
| queue | string | index |
| payload | longText | requerido |
| attempts | unsignedTinyInteger | requerido |
| reserved_at | unsignedInteger | nullable |
| available_at | unsignedInteger | requerido |
| created_at | unsignedInteger | requerido |

## job_batches
| Campo | Tipo | Restricciones |
|---|---|---|
| id | string | PK |
| name | string | requerido |
| total_jobs | integer | requerido |
| pending_jobs | integer | requerido |
| failed_jobs | integer | requerido |
| failed_job_ids | longText | requerido |
| options | mediumText | nullable |
| cancelled_at | integer | nullable |
| created_at | integer | requerido |
| finished_at | integer | nullable |

## failed_jobs
| Campo | Tipo | Restricciones |
|---|---|---|
| id | bigint (id) | PK |
| uuid | string | unico |
| connection | text | requerido |
| queue | text | requerido |
| payload | longText | requerido |
| exception | longText | requerido |
| failed_at | timestamp | useCurrent |

## empleados
| Campo | Tipo | Restricciones |
|---|---|---|
| id | bigint (id) | PK |
| codigo | string(30) | unico, requerido |
| numero_documento | string(30) | unico, requerido |
| nombres | string | requerido |
| apellidos | string | requerido |
| cargo | string | nullable |
| condicion_laboral | string | nullable |
| estado | boolean | default true |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

## feriados
| Campo | Tipo | Restricciones |
|---|---|---|
| id | bigint (id) | PK |
| nombre | string | requerido |
| fecha | date | unico, requerido |
| es_recuperable | boolean | default false |
| estado | boolean | default true |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

## horarios
| Campo | Tipo | Restricciones |
|---|---|---|
| id | bigint (id) | PK |
| nombre | string | requerido |
| hora_entrada | time | requerido |
| hora_salida | time | requerido |
| tolerancia_minutos | unsignedSmallInteger | default 0 |
| estado | boolean | default true |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

## turnos
| Campo | Tipo | Restricciones |
|---|---|---|
| id | bigint (id) | PK |
| nombre | string | requerido |
| hora_inicio | time | requerido |
| hora_fin | time | requerido |
| estado | boolean | default true |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

## periodos
| Campo | Tipo | Restricciones |
|---|---|---|
| id | bigint (id) | PK |
| nombre | string | requerido |
| fecha_inicio | date | requerido |
| fecha_fin | date | requerido |
| cerrado | boolean | default false |
| estado | boolean | default true |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

## tipo_boletas
| Campo | Tipo | Restricciones |
|---|---|---|
| id | bigint (id) | PK |
| nombre | string | requerido |
| descripcion | text | nullable |
| estado | boolean | default true |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |