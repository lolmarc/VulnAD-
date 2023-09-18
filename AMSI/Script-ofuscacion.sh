#!/bin/bash

# Verificar si se proporcionó un nombre de script como argumento
if [ $# -eq 0 ]; then
    echo "ERROR: Debes proporcionar el nombre del script como argumento."
    exit 1
fi

# Ruta y nombre del archivo de script en PowerShell
script_name="$1"

# Verificar si el archivo de script existe
while [ ! -f "$script_name" ]; do
    echo "El archivo $script_name no existe. Por favor, introduce un nombre de script válido:"
    read script_name
done

# Preguntar dónde guardar el archivo codificado
echo "Introduce la ruta y nombre del archivo donde deseas guardar el contenido codificado:"
read output_file

# Convertir todo el contenido del archivo en base64, darle la vuelta y guardar en el archivo especificado
cat "$script_name" | base64 -w 0 | rev > "$output_file"

echo "El contenido de $script_name se ha convertido a base64, invertido y guardado en $output_file"