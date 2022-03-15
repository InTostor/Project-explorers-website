path = str(__file__).replace("convert-text-to-json.py", "")


def file_manipulation(data):
    try:
        listed = data.readlines()
        for i in range(0, len(listed)):
            listed[i] = listed[i].replace("\n", "")
            listed[i] = listed[i] + "<br>"
        stringed = "".join(listed)
        stringed = '"' + stringed + '"'
        return stringed

    finally:
        file.close()


try:
    file = open(
        path + "text.txt",
        "r",
    )
    toSave = file_manipulation(file)
    f = open(path + "jsoned.txt", "w")
    f.write(toSave)
    f.close()

except Exception as excpt:
    print(excpt)

print("done")
