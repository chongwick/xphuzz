files=($(find $1 -name \*.inc -print))
#ogd=$(pwd)
#files=($(find $1 -maxdepth 1 -type f))
cd $2
for file in "${files[@]}"; do
        #ln -s "$file" "$2/$(basename "$file")"
    #ln -s "$file"
    ln -s "../$file"
done
