
public class Shift {

	public static void main(String[] args) {
		int ds = 26;
		String plaintext = "s3054047";

		int enterKey = 3;

		int key = enterKey % 26;
		char[] characters = plaintext.toCharArray();

		System.out.println("Plaintext:");
		for (char c : characters) {
			int number = (int) c;
			System.out.print(number + " ");
		}
		System.out.println();
		for (char c : characters) {
			int number = (int) c;
			char letter = (char) (number);
			System.out.print(letter);
		}

		System.out.println("\n\nCiphertext shifted by \"" + key + "\" characters:");
		for (char c : characters) {
			int number = (int) c;
			int sub = number - key;
			if (key == ds) {
				sub = number;
			}

			if (sub == 32 - key)
				sub = 46;
			else if (sub >= 91 && sub <= 96)
				sub -= 6;
			else if (sub < 65)
				sub += 58;
			System.out.print(sub + " ");
		}
		System.out.println();
		for (char c : characters) {
			int number = (int) c;
			int sub = number - key;
			if (key == ds) {
				sub = number;
			}

			if (sub == 32 - key)
				sub = 46;
			else if (sub >= 91 && sub <= 96)
				sub -= 6;
			else if (sub < 65)
				sub += 58;
			char letter = (char) (sub);
			System.out.print(letter);
		}

	}

}
